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


// PG01
Route::get('/', [ContactController::class, 'index']);

// PG02
Route::POST('/confirm', [ContactController::class, 'confirm']);

// PG03
Route::POST('/thanks', [ContactController::class, 'store']);

// PG04
Route::middleware('auth')->group(function () {
    Route::get('/admin', [ManagementController::class, 'index']);
});

// PG05
Route::match(['GET', 'POST'], '/search', [ManagementController::class, 'search']);

// PG06
Route::get('/reset', [ManagementController::class, 'reset']);

// PG07
Route::delete('/delete/{id}', [ManagementController::class, 'remove']);

// PG08
// PG09
// PG10
// fortify

// PG11
// // ★ エクスポート（表示ページ分だけ）
// Route::get('/export', [ManagementController::class, 'export'])->name('contacts.export');



