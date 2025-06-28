<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Widgets;

class WidgetsController extends Controller
{
    // List all widgets
    public function index()
    {
        $widgets = Widgets::all();
        return response()->json($widgets);
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
