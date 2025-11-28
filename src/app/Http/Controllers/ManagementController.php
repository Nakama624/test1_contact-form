<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ManagementController extends Controller
{
  // 管理画面を表示
  public function index(){
    $categories = DB::table('categories')->get();
    $contacts   = Contact::Paginate(7);

    session()->forget('contacts_search');

    return view('admin', [
      'categories' => $categories,
      'contacts'   => $contacts,
      'search'     => [],
    ]);
  }

  // 検索
  public function search(Request $request)
  {
    $categories = DB::table('categories')->get();
    $query = Contact::query();
    $search = [];

    // メール or 名前
    if ($request->filled('name_email')) {
      $keyword = $request->name_email;
      $search['name_email'] = $keyword;

      $query->where(function ($q) use ($keyword) {
        $q->where('email', 'LIKE', "%{$keyword}%")
          ->orWhere('last_name', 'LIKE', "%{$keyword}%")
          ->orWhere('first_name', 'LIKE', "%{$keyword}%")
          ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"]);
      });
    }

    // 性別
    // 選択肢全て（0）に対応
    if ($request->filled('gender') && $request->gender !== '0') {
      $query->where('gender', $request->gender);
      $search['gender'] = $request->gender;
    }

    // カテゴリ
    if ($request->filled('category_id')) {
      $query->where('category_id', $request->category_id);
      $search['category_id'] = $request->category_id;
    }

    // 作成日
    if ($request->filled('created_at')) {
      $query->whereDate('created_at', $request->created_at);
      $search['created_at'] = $request->created_at;
    }   

    $contacts = $query->paginate(7);
    session(['contacts_search' => $search]);
    
    return view('admin', [
      'categories' => $categories,
      'contacts' => $contacts,
      'search' => $search,
    ]);
  }

  // 検索リセット
  public function reset()
  {
    session()->forget('contacts_search');

    $categories = DB::table('categories')->get();
    $contacts = Contact::Paginate(7);

    return view('admin', [
      'categories' => $categories,
      'contacts'   => $contacts,
      'search'     => [],
    ]);
  } 

  // お問い合わせ削除
  public function remove($id)
  {
    Contact::findOrFail($id)->delete();
    return redirect('/admin');
  }



// エクスポート
  public function export(): StreamedResponse
  {
    $search = session('contacts_search', []);

    $query = Contact::query();

    // === search() と同じ ===
    if (!empty($search['name_email'])) {
        $keyword = $search['name_email'];
        $query->where(function ($q) use ($keyword) {
          $q->where('email', 'LIKE', "%{$keyword}%")
            ->orWhere('last_name', 'LIKE', "%{$keyword}%")
            ->orWhere('first_name', 'LIKE', "%{$keyword}%")
            ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"]);
        });
    }

    if (!empty($search['gender']) && $search['gender'] !== '0') {
      $query->where('gender', $search['gender']);
    }

    if (!empty($search['category_id'])) {
      $query->where('category_id', $search['category_id']);
    }

    if (!empty($search['created_at'])) {
      $query->whereDate('created_at', $search['created_at']);
    }

    $contacts   = $query->get();
    $categories = DB::table('categories')->get()->keyBy('id');

    $response = new StreamedResponse(function () use ($contacts, $categories) {
      $output = fopen('php://output', 'w');

      // ヘッダー行
      $header = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '電話番号', '住所', '建物名', 'お問い合わせ内容', '作成日'];
      fputcsv($output, array_map(fn($v) => mb_convert_encoding($v, 'SJIS-win', 'UTF-8'), $header));

      $genderText = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
      ];

      foreach ($contacts as $contact) {
        $row = [
          $contact->last_name . ' ' . $contact->first_name,
          $genderText[$contact->gender] ?? '',
          $contact->email,
          $categories[$contact->category_id]->content ?? '',
          $contact->tel,
          $contact->address,
          $contact->building,
          $contact->detail,
          $contact->created_at->format('Y-m-d H:i:s'),
        ];

        $row = array_map(fn($v) => mb_convert_encoding($v, 'SJIS-win', 'UTF-8'), $row);

        fputcsv($output, $row);
      }
      fclose($output);
    });
// 　ファイル名：contacts_YYYYMMDD_HHMMSS.csv
    $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

    $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
    $response->headers->set('Content-Disposition', "attachment; filename=\"{$filename}\"");

    return $response;
  }

}


