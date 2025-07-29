<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\User;
use Yajra\DataTables\DataTables;

class InvoicesController extends Controller
{
    // List all invoices
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Invoices::with('customer')->orderBy('id', 'desc')->select([
            'id',
            'total',
            'title',
            'description',
            'created_by',
            'assigned_to',
            'expires',
            'status'
        ]);

        return DataTables::of($data)
->editColumn('description', function ($item) {
    $cleanText = strip_tags($item->description); // remove HTML
    return strlen($cleanText) > 10 ? substr($cleanText, 0, 10) . '...' : $cleanText;
})
            ->editColumn('status', function ($item) {
                if ($item->status == 1) {
                    return '<span class="badge badge-success">Paid</span>';
                } elseif ($item->status == 2) {
                   return '<span class="badge badge-danger">Unpaid</span>';
                }
                return '<span class="badge badge-dark">Unknown</span>';
            })
                ->editColumn('total', function ($item) {
        return '$' . $item->total;
    })
            ->editColumn('expires', function ($item) {
    return \Carbon\Carbon::parse($item->expires)->format('d M Y');
})->addColumn('customer', function ($item) {
    return $item->customer
        ? trim($item->customer->first_name . ' ' . $item->customer->last_name)
        : '-';
})

->addColumn('actions', function ($item) {
  $editUrl = route('invoices.edit', ['locale' => app()->getLocale(), 'id' => $item->id]);
    return '
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i> Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                <a class="dropdown-item" href="' . $editUrl . '">
                    <i class="fas fa-edit"></i> &nbsp;Edit
                </a>
                <a class="dropdown-item text-danger delete-invoice" href="javascript:void(0);" data-id="' . $item->id . '">
                    <i class="fas fa-trash"></i> &nbsp;Delete
                </a>
            </div>
        </div>
    ';
})
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    return view('dashboard.admin.invoice.index');
}


    // Show a single invoice
    public function show($id)
    {
        $invoice = Invoices::findOrFail($id);
        return response()->json($invoice);
    }

       public function create()
    {
        $users = User::all();
        return view('dashboard.admin.invoice.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
            'status' => 'required|in:1,2',
            'assigned_to' => 'nullable|exists:users,id',
            'total' => 'required|numeric',
            'expires' => 'nullable|date',
            'term' => 'nullable|string|max:255',
        ]);

        Invoices::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'total' => $request->total,
            'expires' => $request->expires,
            'term' => $request->term,
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }

    public function edit($locale, $id)
    {
        $invoice = Invoices::findOrFail($id);
        $users = User::all();
        return view('dashboard.admin.invoice.edit', compact('invoice', 'users'));
    }

    public function update(Request $request, $locale, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'created_by' => 'required|exists:users,id',
            'status' => 'required|in:1,2',
            'assigned_to' => 'nullable|exists:users,id',
            'total' => 'required|numeric',
            'expires' => 'nullable|date',
            'term' => 'nullable|string|max:255',
        ]);

        $invoice = Invoices::findOrFail($id);
        $invoice->update([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => $request->created_by,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'total' => $request->total,
            'expires' => $request->expires,
            'term' => $request->term,
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    public function destroy($locale,$id)
    {
        $invoice = Invoices::findOrFail($id);
        $invoice->delete();
        return response()->json(['success' => 'Invoice deleted successfully!']);
    }
}
