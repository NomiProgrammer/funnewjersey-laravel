<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Widgets;
use App\Models\Settings;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
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
                })->addColumn('id', function ($item) {

                    return $item->id;
                })

                ->addColumn('actions', function ($item) {
                    $editUrl = route('widgets.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
                    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-widget" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('dashboard.admin.widgets.index');
    }



    public function create()
    {
        return view('dashboard.admin.widgets.create');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);

        Widgets::create([
            'name' => $request->name,
            'alias' => Str::slug($request->name, '_'),
            'status' => $request->status,
            'editable' => 1,
        ]);

        return redirect()->route('widgets.index')->with('success', 'Widget created successfully!');
    }

    public function edit($locale, $id)
    {
        $widget = Widgets::findOrFail($id);
        return view('dashboard.admin.widgets.edit', compact('widget'));
    }

    // Update a widget (demo data)
    public function update(Request $request, $locale, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:1,2',
        ]);
        $widget = Widgets::findOrFail($id);


        $widget->update([
            'name' => $request->name,
            'alias' => Str::slug($request->name, '_'),
            'status' => $request->status,
            'editable' => 1,
        ]);

        return redirect()->route('widgets.index')->with('success', 'Widget updated successfully!');
    }


    public function destroy($locale, $id)
    {
        $widget = Widgets::findOrFail($id);
        $widget->delete();

        return response()->json(['success' => 'Widget deleted successfully!']);
    }
public function widgetpositions(Request $request)
{
    $row = \App\Models\Settings::where('key', 'positions')->first();

    $positions = [];
    if ($row) {
        $positions = json_decode($row->values, true); // decode as array
    }

    $selected_pos = $request->input('position') ?? ($positions[0]['name'] ?? '');

    $active_widgets = [];
    foreach ($positions as $pos) {
        if ($pos['name'] === $selected_pos) {
            $active_widgets = $pos['widgets'] ?? [];
            break;
        }
    }

    $widgets = \App\Models\Widgets::all(); // assuming your model is App\Models\Widgets

    return view('dashboard.admin.widgets.widgetpositions', compact(
        'positions', 'selected_pos', 'active_widgets', 'widgets'
    ));
}

public function getContent($locale, $alias)
{
        Log::info('getContent() called', ['alias' => $alias]);
    $path = resource_path("views/widgets/{$alias}.php");

        Log::info("Checking for widget content file:", ['alias' => $alias, 'path' => $path]);

        if (!File::exists($path)) {
            Log::warning("File not found for alias: $alias", ['path' => $path]);

            return response()->json([
                'error' => 'File not found',
                'path' => $path,
            ], 404);
        }

        $content = File::get($path);

        return response()->json([
            'content' => $content
        ]);
    }

    public function updateContent(Request $request, $locale, $alias)
    {
        $path = resource_path("views/widgets/{$alias}.php");

        if (!File::exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        File::put($path, $request->input('content'));

        return response()->json(['success' => 'Widget content updated successfully.']);
    }
}
