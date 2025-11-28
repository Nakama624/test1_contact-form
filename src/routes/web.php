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

// PG04　PG05　PG06　PG07　PG11
Route::middleware('auth')->group(function () {
  Route::get('/admin', [ManagementController::class, 'index']);
  Route::match(['GET', 'POST'], '/search', [ManagementController::class, 'search']);
  Route::get('/reset', [ManagementController::class, 'reset']);
  Route::delete('/delete/{id}', [ManagementController::class, 'remove']);
  Route::get('/export', [ManagementController::class, 'export']);
});

// PG08
// PG09
// PG10
// fortify