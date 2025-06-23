<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard.admin.pages.index');
  }

  public function create()
  {
    return view('dashboard.admin.base.create');
  }

  public function manage()
  {
    return view('dashboard.admin.base.index');
  }
}
