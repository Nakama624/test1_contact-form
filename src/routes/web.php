<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ManagementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// ＝＝＝お問い合わせフォーム＝＝＝
// 1.入力画面
Route::get('/', [ContactController::class, 'index']);

// 2.お問い合わせ確認画面
Route::POST('/confirm', [ContactController::class, 'confirm']);

// 3.サンクスページ
Route::POST('/thanks', [ContactController::class, 'store']);

// ＝＝＝認証＝＝＝
// 4.確認画面
Route::get('/register', [CertificationController::class, 'index']);
Route::POST('/register', [CertificationController::class, 'store']);

// 5.ログイン画面
Route::get('/login', [CertificationController::class, 'login']);

// ＝＝＝管理画面＝＝＝
// 6.管理画面
Route::get('/admin', [ManagementController::class, 'index']);
