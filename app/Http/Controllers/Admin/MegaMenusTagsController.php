<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MegaMenusTags;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Locations;
class MegaMenusTagsController extends Controller
{
    // List all mega menu tags
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = MegaMenusTags::with(['categoryid','location'])->orderBy('id', 'asc')->select([
            'category',
            'id',
            'county',
            'city',
            'region',
            'h1',
            'metatitle',
            'metadesc',
            'metakeywords'
        ]);

        return datatables()->of($data)
                    ->addColumn('category', function ($item) {
    return $item->categoryid ? $item->categoryid->title : '-';
})
            ->addColumn('location', function ($item) {
    return $item->location ? $item->location->name : '-';
})
->addColumn('actions', function ($item) {
  $editUrl = route('meta_tags.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-metas" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
->editColumn('region', function ($item) {
    switch ($item->region) {
        case 1:
            return '<span class="badge badge-primary">Northern</span>';
        case 2:
            return '<span class="badge badge-warning">Central</span>';
        case 3:
            return '<span class="badge badge-info">Southern</span>';
        default:
            return '<span class="badge badge-secondary">Unknown</span>';
    }
})
             ->rawColumns(['region', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.meta_tags.index');
}


  public function create()
{
    $categories = Category::all();
    $locations = Locations::all();

    return view('dashboard.admin.meta_tags.create', compact('categories', 'locations'));
}

public function store(Request $request)
{
    $request->validate([
        'category' => 'required|exists:categories,id',
        'county' => 'nullable|exists:locations,id',
        'city' => 'nullable|exists:locations,id',
        'region' => 'required|in:1,2,3',
        'h1' => 'nullable|string|max:255',
        'metatitle' => 'nullable|string|max:255',
        'metadesc' => 'nullable|string|max:500',
        'metakeywords' => 'nullable|string|max:500',
        'pagetop' => 'nullable|string',
        'pagebottom' => 'nullable|string',
        'disableh1' => 'nullable|boolean',
    ]);

    $data = $request->all();
    $data['disableh1'] = $request->has('disableh1') ? 1 : 0;

    MegaMenusTags::create($data);

    return redirect()->route('meta_tags.index')->with('success', 'Meta Tags created successfully!');
}

public function edit($locale, $id)
{
    $meta = MegaMenusTags::findOrFail($id);
    $categories = Category::all();
    $locations = Locations::all();

    return view('dashboard.admin.meta_tags.edit', compact('meta', 'categories', 'locations'));
}

public function update(Request $request, $locale, $id)
{
    $request->validate([
        'category' => 'required|exists:categories,id',
        'county' => 'nullable|exists:locations,id',
        'city' => 'nullable|exists:locations,id',
        'region' => 'required|in:1,2,3',
        'h1' => 'nullable|string|max:255',
        'metatitle' => 'nullable|string|max:255',
        'metadesc' => 'nullable|string|max:500',
        'metakeywords' => 'nullable|string|max:500',
        'pagetop' => 'nullable|string',
        'pagebottom' => 'nullable|string',
        'disableh1' => 'nullable|boolean',
    ]);

    $meta = MegaMenusTags::findOrFail($id);

    $data = $request->all();
    $data['disableh1'] = $request->has('disableh1') ? 1 : 0;

    $meta->update($data);

    return redirect()->route('meta_tags.index')->with('success', 'Meta Tags updated successfully!');
}

public function destroy($locale, $id)
{
    $meta = MegaMenusTags::findOrFail($id);
    $meta->delete();

    return response()->json(['success' => 'Meta Tag deleted successfully!']);
}
}
