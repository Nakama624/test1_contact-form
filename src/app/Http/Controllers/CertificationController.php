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
}

