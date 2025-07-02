<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Widgets;
use Yajra\DataTables\DataTables;

class WidgetsController extends Controller
{
    // List all widgets
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Widgets::select(['id', 'name', 'status']);

        return datatables()->of($data)
            ->editColumn('status', function ($item) {
                // 1 means deactivated, 0 means active
                if ($item->status == 1) {
                    return '<span class="badge badge-danger">Deactivated</span>';
                } else {
                    return '<span class="badge badge-success">Active</span>';
                }
            })
            ->addColumn('actions', function ($item) {
                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> &nbsp;Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> &nbsp;Delete</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.widgets.index');
}


    // Show a single widget
    public function show($id)
    {
        $widget = Widgets::findOrFail($id);
        return response()->json($widget);
    }

    // Store a new widget (demo data)
    public function store(Request $request)
    {
        $widget = Widgets::create([
            'name' => 'Demo Widget',
        ]);
        return response()->json($widget);
    }

    // Update a widget (demo data)
    public function update(Request $request, $id)
    {
        $widget = Widgets::findOrFail($id);
        $widget->update([
            'name' => 'Updated Widget',
        ]);
        return response()->json($widget);
    }

    // Delete a widget
    public function destroy($id)
    {
        $widget = Widgets::findOrFail($id);
        $widget->delete();
        return response()->json(['message' => 'Widget deleted']);
    }
}
