<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Settings;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{
    // List all pages
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Pages::select(['id','title', 'content', 'status']);

        return datatables()->of($data)
            ->editColumn('content', function ($row) {
    return Str::limit(strip_tags($row->content), 50); // Use Illuminate\Support\Str
})
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge badge-warning">Drafted</span>';
                } else {
                    return '<span class="badge badge-secondary">Unknown</span>';
                }
            })

->addColumn('actions', function ($item) {
  $editUrl = route('pages.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-pages" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.pages_menu.index');
}


    // Show a single page
    public function show($id)
    {
        $page = Pages::findOrFail($id);
        return response()->json($page);
    }

        public function create()
    {
        return view('dashboard.admin.pages_menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alias' => 'nullable|string|max:255',
            'show_in_menu' => 'required|in:0,1',
            'layout' => 'required|in:1,2,3',
            'content_from' => 'required|in:url,manual',
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'seo_settings.meta_title' => 'nullable|string|max:255',
            'seo_settings.meta_description' => 'nullable|string',
            'seo_settings.key_words' => 'nullable|string',
            'seo_settings.crawl_after' => 'nullable|integer',
            'status' => 'required|in:1,2',
        ]);

        $seo = json_encode([
            'meta_title' => $request->input('seo_settings.meta_title'),
            'meta_description' => $request->input('seo_settings.meta_description'),
            'key_words' => $request->input('seo_settings.key_words'),
            'crawl_after' => $request->input('seo_settings.crawl_after'),
        ]);

        Pages::create([
            'alias' => $request->alias ?: Str::slug($request->title, '_'),
            'show_in_menu' => $request->show_in_menu,
            'layout' => $request->layout,
            'content_from' => $request->content_from,
            'title' => $request->title,
            'url' => $request->url,
            'content' => $request->content,
            'seo_settings' => $seo,
            'create_time' => now(),
            'status' => $request->status,
        ]);

        return redirect()->route('pages.index')->with('success', 'Page created successfully!');
    }

    public function edit($locale, $id)
    {
        $page = Pages::findOrFail($id);
        $seo = json_decode($page->seo_settings, true);
        return view('dashboard.admin.pages_menu.edit', compact('page', 'seo'));
    }

    public function update(Request $request, $locale,$id)
    {
        $request->validate([
            'alias' => 'nullable|string|max:255',
            'show_in_menu' => 'required|in:0,1',
            'layout' => 'required|in:1,2,3',
            'content_from' => 'required|in:url,manual',
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'seo_settings.meta_title' => 'nullable|string|max:255',
            'seo_settings.meta_description' => 'nullable|string',
            'seo_settings.key_words' => 'nullable|string',
            'seo_settings.crawl_after' => 'nullable|integer',
            'status' => 'required|in:1,2',
        ]);

        $page = Pages::findOrFail($id);

        $seo = json_encode([
            'meta_title' => $request->input('seo_settings.meta_title'),
            'meta_description' => $request->input('seo_settings.meta_description'),
            'key_words' => $request->input('seo_settings.key_words'),
            'crawl_after' => $request->input('seo_settings.crawl_after'),
        ]);

        $page->update([
            'alias' => $request->alias ?: Str::slug($request->title, '_'),
            'show_in_menu' => $request->show_in_menu,
            'layout' => $request->layout,
            'content_from' => $request->content_from,
            'title' => $request->title,
            'url' => $request->url,
            'content' => $request->content,
            'seo_settings' => $seo,
            'status' => $request->status,
        ]);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
    }

    public function destroy($locale,$id)
    {
        $page = Pages::findOrFail($id);
        $page->delete();

        return response()->json(['success' => 'Page deleted successfully!']);
    }

    public function menu()
    {
        $topMenuSetting = Settings::where('key', 'top_menu')->first();
        $menuPages = [];
        $menuIds = [];

        if ($topMenuSetting && !empty($topMenuSetting->values)) {
            $menuStructure = json_decode($topMenuSetting->values, true);

            if (is_array($menuStructure)) {
                // Recursive function to extract all IDs from the nested structure
                $getIds = function ($items) use (&$getIds) {
                    $ids = [];
                    foreach ($items as $item) {
                        $ids[] = $item['id'];
                        if (!empty($item['children'])) {
                            $ids = array_merge($ids, $getIds($item['children']));
                        }
                    }
                    return $ids;
                };
                $menuIds = $getIds($menuStructure);

                if (!empty($menuIds)) {
                    $pages = Pages::whereIn('id', $menuIds)->where('status', 1)->get()->keyBy('id');

                    // Recursive function to build the ordered list of pages with correct parent IDs
                    $buildPages = function ($items, $parentId = 0) use (&$buildPages, $pages, &$menuPages) {
                        foreach ($items as $item) {
                            if (isset($pages[$item['id']])) {
                                $page = $pages[$item['id']];
                                $page->parent_id = $parentId;
                                $menuPages[] = $page;

                                if (!empty($item['children'])) {
                                    $buildPages($item['children'], $item['id']);
                                }
                            }
                        }
                    };
                    $buildPages($menuStructure);
                }
            }
        }

        // Get pages that are available to be in a menu but are not currently
        $notInMenuss = Pages::where('show_in_menu', 1)
                            ->where('status', 1)
                            ->whereNotIn('id', $menuIds)
                            ->get();

        return view('dashboard.admin.pages_menu.menu', compact('menuPages', 'notInMenuss'));
    }

    public function updateMenu(Request $request)
    {
        $menuData = $request->input('top_menu');

        if (is_null($menuData)) {
            return back()->with('error', 'No menu data received.');
        }

        Settings::updateOrCreate(
            ['key' => 'top_menu'],
            ['values' => $menuData]
        );

        return redirect()->route('pages.menu', ['locale' => app()->getLocale()])->with('success', 'Menu updated successfully!');
    }
}
