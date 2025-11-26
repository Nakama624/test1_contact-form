<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ManagementController extends Controller
{
  // 管理画面を表示
  public function index(){
    $categories = DB::table('categories')->get();
    $contacts   = Contact::Paginate(7);
    return view('admin', [
          'categories' => $categories,
          'contacts'   => $contacts,
    ]);
  }

  // 検索
  // public function find()
  // {
  //     $categories = DB::table('categories')->get();
  //     return view('find', ['input' => '']);
  // }

  public function search(Request $request)
  {
    $categories = DB::table('categories')->get();
    $query = Contact::query();

    // メール or 名前
    if ($request->filled('name_email')) {
      $keyword = $request->name_email;

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
    }

    // カテゴリ
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 作成日
    if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }   

    $search = $request->only(['name_email', 'gender', 'category_id', 'created_at']);
    $contacts = $query->paginate(7)->appends($search);
    
    return view('admin', [
        'categories' => $categories,
        'contacts'   => $contacts,
        'search'     => $search,
    ]);
  }

  public function reset()
  {
    $categories = DB::table('categories')->get();
    $contacts = Contact::Paginate(7);

    return view('admin', compact('categories', 'contacts'));
  } 





  // お問い合わせフォーム削除
  public function remove($id)
  {
    Contact::findOrFail($id)->delete();
    return redirect('/admin');
  }
}


