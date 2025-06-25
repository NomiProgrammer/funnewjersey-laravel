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
            ['engine' => 'Trident', 'browser' => 'IE 4.0', 'platform' => 'Win 95+', 'version' => '4', 'grade' => 'X'],
            ['engine' => 'Trident', 'browser' => 'IE 5.0', 'platform' => 'Win 95+', 'version' => '5', 'grade' => 'C'],
            ['engine' => 'Trident', 'browser' => 'IE 5.5', 'platform' => 'Win 95+', 'version' => '5.5', 'grade' => 'A'],
            ['engine' => 'Trident', 'browser' => 'IE 6', 'platform' => 'Win 98+', 'version' => '6', 'grade' => 'A'],
            ['engine' => 'Trident', 'browser' => 'IE 7', 'platform' => 'Win XP SP2+', 'version' => '7', 'grade' => 'A'],
            ['engine' => 'Trident', 'browser' => 'AOL Browser', 'platform' => 'Win XP', 'version' => '6', 'grade' => 'A'],
            ['engine' => 'Other', 'browser' => 'All others', 'platform' => '-', 'version' => '-', 'grade' => 'U'],
        ];

        return DataTables::of($data)->make(true);
    }

    return view('dashboard.admin.base.index');
}
}
