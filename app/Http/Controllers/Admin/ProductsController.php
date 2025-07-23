<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Products::where('type', 'product')
            ->select(['id', 'title', 'price', 'shipping','description', 'featured_img', 'type']); // include type

        return datatables()->of($data)
            ->editColumn('title', function ($row) {
                return $row->title ?? '-';
            })
            ->editColumn('price', function ($row) {
                return '$' . number_format($row->price, 2);
            })
            ->editColumn('shipping', function ($row) {
                return $row->shipping ? '$' . number_format($row->shipping, 2) : 'Free';
            })
            ->editColumn('type', function ($row) {
                return ucfirst($row->type); // Capitalize if needed
            })
            ->editColumn('description', function ($row) {
    return Str::limit(strip_tags($row->description), 50); // Use Illuminate\Support\Str
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
                $editUrl = route('products.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
                return '
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i> Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                            <a class="dropdown-item" href="' . $editUrl . '">
                                <i class="fas fa-edit"></i> &nbsp;Edit
                            </a>
                            <a class="dropdown-item text-danger delete-product" href="javascript:void(0);" data-id="' . $item->id . '">
                                <i class="fas fa-trash"></i> &nbsp;Delete
                            </a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['status', 'actions','featured_img'])
            ->make(true);
    }

    return view('dashboard.admin.products.index');
}


    public function create()
    {
        return view('dashboard.admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'shipping' => 'nullable|numeric',
            'description' => 'nullable|string',
            'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['type'] = 'product'; // fixed hidden type
        $data['created_by'] = Auth::id();
        $data['create_time'] = time();

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('front_assets/uploads/products/'), $imageName);
            $data['featured_img'] = 'front_assets/uploads/products/' . $imageName;
        }

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit($locale, $id)
    {
        $product = Products::findOrFail($id);
        return view('dashboard.admin.products.edit', compact('product'));
    }

    public function update(Request $request, $locale, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'shipping' => 'nullable|numeric',
            'description' => 'nullable|string',
            'featured_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Products::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('front_assets/uploads/products/'), $imageName);
            $data['featured_img'] = 'front_assets/uploads/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($locale, $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return response()->json(['success' => 'Product deleted successfully!']);
    }
}
