<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

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
            $data = User::select(['id', 'name', 'email', 'email_verified_at', 'created_at']);
            return DataTables::of($data)->make(true);
        }

        return view('dashboard.admin.base.index');
    }
}
