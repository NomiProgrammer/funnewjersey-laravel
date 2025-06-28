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
