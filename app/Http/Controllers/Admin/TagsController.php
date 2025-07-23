<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class TagsController extends Controller
{
    // List all tags
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Tags::orderBy('id', 'asc')->select(['id', 'title']);

        return datatables()->of($data)
->addColumn('actions', function ($item) {
  $editUrl = route('tags.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-tag" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['actions'])
            ->make(true);
    }

    return view('dashboard.admin.tags.index');
}



     public function create()
    {
        return view('dashboard.admin.tags.create');
    }


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'parent' => 'nullable|integer',
        'metatitle2' => 'nullable|string|max:255',
        'metakeywords2' => 'nullable|string',
        'metadescription2' => 'nullable|string',
        'catdesc' => 'nullable|string',
        'catdesc2' => 'nullable|string',
    ]);
$createTime = time();
    Tags::create([
        'title' => $request->title,
        'parent' => $request->parent ?? 0,
        'metatitle2' => $request->metatitle2,
        'metakeywords2' => $request->metakeywords2,
        'metadescription2' => $request->metadescription2,
        'catdesc' => $request->catdesc,
        'catdesc2' => $request->catdesc2,
        'created_by' => Auth::id(), // ✅ add this line
        'create_time' => time(), // UNIX timestamp
    ]);

    return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
}

    public function edit($locale, $id)
    {
        $tag = Tags::findOrFail($id);
        $parents = ['' => 'No Parent', 'dogfriendly' => 'Dog Friendly', 'fun outdoor activities' => 'Fun Outdoor Activities', 'historical places' => 'Historical Places', 'kid friendly attraction' => 'Kid Friendly Attraction'];
        return view('dashboard.admin.tags.edit', compact('tag', 'parents'));
    }

public function update(Request $request, $locale, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'parent' => 'nullable|integer',
        'metatitle2' => 'nullable|string|max:255',
        'metakeywords2' => 'nullable|string',
        'metadescription2' => 'nullable|string',
        'catdesc' => 'nullable|string',
        'catdesc2' => 'nullable|string',
    ]);

    $tag = Tags::findOrFail($id);
    $tag->update([
        'title' => $request->title,
        'parent' => $request->parent ?? 0,
        'metatitle2' => $request->metatitle2,
        'metakeywords2' => $request->metakeywords2,
        'metadescription2' => $request->metadescription2,
        'catdesc' => $request->catdesc,
        'catdesc2' => $request->catdesc2,
        'created_by' => Auth::id(), // ✅ add this line
    ]);

    return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
}


    public function destroy($locale,$id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
