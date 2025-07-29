<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FunDeals;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class FunDealsController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = FunDeals::where('type', 'deal')
            ->select(['id', 'title', 'price','terms','description', 'featured_img', 'type','status']); // include type

        return datatables()->of($data)
            ->editColumn('title', function ($row) {
                return $row->title ?? '-';
            })
            ->editColumn('type', function ($row) {
                return ucfirst($row->type); // Capitalize if needed
            })
->editColumn('description', function ($item) {
    $cleanText = strip_tags($item->description); // remove HTML
    return strlen($cleanText) > 10 ? substr($cleanText, 0, 10) . '...' : $cleanText;
})
            ->editColumn('featured_img', function ($row) {
                if ($row->featured_img) {
                    return '<img src="' . asset($row->featured_img) . '" width="60">';
                }
                return '-';
            })
                        ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Published</span>';
                } elseif ($row->status == 0) {
                    return '<span class="badge badge-danger">Unpublished</span>';
                } elseif ($row->status == 2) {
                    return '<span class="badge badge-warning">Drafted</span>';
                } else {
                    return '<span class="badge badge-secondary">Unknown</span>';
                }
            })
            ->addColumn('actions', function ($item) {
                $editUrl = route('deals.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                            <a class="dropdown-item" href="' . $editUrl . '">
                                <i class="fas fa-edit"></i> &nbsp;Edit
                            </a>
                            <a class="dropdown-item text-danger delete-deal" href="javascript:void(0);" data-id="' . $item->id . '">
                                <i class="fas fa-trash"></i> &nbsp;Delete
                            </a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['status', 'actions','featured_img'])
            ->make(true);
    }

    return view('dashboard.admin.deals.index');
}


    public function create()
    {
        return view('dashboard.admin.deals.create');
    }



public function store(Request $request)
{
    $data = $request->validate([
        'title'        => 'required|string|max:255',
        'price'        => 'required|string|max:255',
        'deal_limit'   => 'required|string|max:255',
        'terms'        => 'nullable|string',
        'description'  => 'nullable|string',
        'featured_img' => 'nullable|image',
    ]);

    // Wrap title and description in JSON with 'en' as the key
    $data['title'] = json_encode(['en' => $data['title']]);
    $data['description'] = json_encode(['en' => $data['description'] ?? '']);

    $data['type'] = 'deal';
    $data['created_by'] = Auth::id();
    $data['create_time'] = time();
    $data['status'] = "1";

    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $name = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/deals/'), $name);
        $data['featured_img'] = $name;
    }

    FunDeals::create($data);

    return redirect()->route('deals.index')->with('success', 'Deal created successfully.');
}


    public function edit($locale, $id)
    {
        $deals = FunDeals::findOrFail($id);
        return view('dashboard.admin.deals.edit', compact('deals'));
    }

public function update(Request $request, $locale, $id)
{
    $deal = FunDeals::findOrFail($id);

    $data = $request->validate([
        'title'        => 'required|string|max:255',
        'price'        => 'required|string|max:255',
        'deal_limit'   => 'required|string|max:255',
        'terms'        => 'nullable|string',
        'description'  => 'nullable|string',
        'featured_img' => 'nullable|image',
    ]);

    // Encode translatable fields as JSON
    $data['title'] = json_encode(['en' => $data['title']]);
    $data['description'] = json_encode(['en' => $data['description'] ?? '']);

    if ($request->hasFile('featured_img')) {
        $image = $request->file('featured_img');
        $name = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('front_assets/uploads/deals/'), $name);
        $data['featured_img'] = $name;
    }

    $deal->update($data);

    return redirect()->route('deals.index')->with('success', 'Deal updated successfully.');
}


    public function destroy($locale, $id)
    {
        $deals = FunDeals::findOrFail($id);
        $deals->delete();

        return response()->json(['success' => 'Deals deleted successfully!']);
    }
}
