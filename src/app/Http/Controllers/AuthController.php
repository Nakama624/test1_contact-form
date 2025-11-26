<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function index()
  {
    // 認証ができていない場合はログイン画面表示
    return view('admin');
  }
}
