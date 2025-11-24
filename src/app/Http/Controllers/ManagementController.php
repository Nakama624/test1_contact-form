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

    $contacts = Contact::Paginate();
    return view('admin', [
          'categories' => $categories,
          'contacts'   => $contacts,
    ]);
  }
}
