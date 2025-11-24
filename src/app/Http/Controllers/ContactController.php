<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  // カテゴリを取得し、お問い合わせフォームを表示
  public function index(){
    $categories = DB::table('categories')->get();
    return view('index', compact('categories'));
  }

  // お問い合わせフォームで入力された値を確認画面で表示
  public function confirm(ContactRequest $request){
    
    $categories = DB::table('categories')->get();
    $contact = $request->only(['first_name', 'last_name', 'gender', 'email','tel1','tel2', 'tel3', 'address', 'building','category_id','detail']);

    return view('confirm', compact('contact', 'categories'));
  }

  // 入力値を保存
  public function store(ContactRequest $request)
  { 
    // 電話番号を結合して代入
    $tel = $request->tel1.$request->tel2.$request->tel3;
    $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building','category_id','detail']);
    $contact['tel'] = $tel;

    Contact::create($contact);

    return view('thanks', compact('contact'));
  }

}
