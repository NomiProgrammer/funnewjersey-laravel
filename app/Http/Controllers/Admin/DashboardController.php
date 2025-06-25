<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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

public function manage(Request $request)
{
    if ($request->ajax()) {
        $data = [
            ['name' => 'Ali', 'email' => 'ali@example.com', 'created_at' => '2024-01-01'],
            ['name' => 'Sara', 'email' => 'sara@example.com', 'created_at' => '2024-02-01'],
            ['name' => 'John', 'email' => 'john@example.com', 'created_at' => '2024-03-15'],
        ];

        return DataTables::of($data)->make(true);
    }

    return view('dashboard.admin.base.index');
}
}
