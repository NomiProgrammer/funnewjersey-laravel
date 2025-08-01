<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\Settings;
use Yajra\DataTables\DataTables;

class PackagesController extends Controller
{
    // List all packages
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Packages::orderBy('id', 'asc')
            ->select(['id', 'title', 'price', 'type', 'expiration_time']);

        return datatables()->of($data)
            ->editColumn('expiration_time', function($row) {
        return $row->expiration_time . ' Days';
    })
    ->editColumn('type', function ($item) {
    return ucwords(str_replace('_', ' ', $item->type));
})
->addColumn('actions', function ($item) {
  $editUrl = route('package.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-package" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('dashboard.admin.packages.index');
}


    // Show a single package
    public function show($id)
    {
        $package = Packages::findOrFail($id);
        return response()->json($package);
    }

    public function create()
    {
        return view('dashboard.admin.packages.create');
    }
    public function settings()
    {
        $settings_json = Settings::where('key', 'package_settings')->value('values');
        $settings = $settings_json ? json_decode($settings_json) : (object)[];

        return view('dashboard.admin.packages.settings', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        $data = $request->except('_token');
        $settings_json = json_encode($data);

        Settings::updateOrCreate(
            ['key' => 'package_settings'],
            ['values' => $settings_json]
        );

        return redirect()->route('package.settings', ['locale' => app()->getLocale()])->with('success', 'Settings saved successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:post_package,featured_package,banner_package,deal_package',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'expiration_time' => 'required|integer|min:1',
            'status' => 'required|in:0,1',
        ]);

        Packages::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'expiration_time' => $request->expiration_time,
            'status' => $request->status,
        ]);

        return redirect()->route('package.index')->with('success', 'Package created successfully!');
    }

    public function edit($locale, $id)
    {
        $package = Packages::findOrFail($id);
        return view('dashboard.admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $locale,$id)
    {
        $request->validate([
            'type' => 'required|in:post_package,featured_package,banner_package,deal_package',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'expiration_time' => 'required|integer|min:1',
            'status' => 'required|in:0,1',
        ]);

        $package = Packages::findOrFail($id);

        $package->update([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'expiration_time' => $request->expiration_time,
            'status' => $request->status,
        ]);

        return redirect()->route('package.index')->with('success', 'Package updated successfully!');
    }

    public function destroy($locale,$id)
    {
        $package = Packages::findOrFail($id);
        $package->delete();

        return response()->json(['success' => 'Package deleted successfully!']);
    }
}
