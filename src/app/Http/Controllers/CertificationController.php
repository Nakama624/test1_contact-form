<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CertificationRequest;
use App\Models\User;

class CertificationController extends Controller
{
  // 会員登録フォームを表示
  public function index(){
    return view('register');
  }


  // // 入力値を保存
  // public function store(CertificationRequest $request)
  // { 
  //   $user = $request->only(['name', 'email', 'password']);
  //   User::create($user);

  //   return view('register');
  // }

  // ログイン画面を表示
  public function login(){
    return view('login');
  }
}

