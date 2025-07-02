<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoices;
use Yajra\DataTables\DataTables;

class InvoicesController extends Controller
{
    // List all invoices
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Invoices::orderBy('id', 'desc')->select([
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
                return $item->description
                    ? (strlen($item->description) > 10 ? substr($item->description, 0, 10) . '...' : $item->description)
                    : '-';
            })
            ->editColumn('status', function ($item) {
                if ($item->status == 1) {
                    return '<span class="badge badge-success">Paid</span>';
                } elseif ($item->status == 2) {
                   return '<span class="badge badge-danger">Unpaid</span>';
                }
                return '<span class="badge badge-dark">Unknown</span>';
            })
            ->editColumn('expires', function ($item) {
    return \Carbon\Carbon::parse($item->expires)->format('d M Y');
})
            ->addColumn('actions', function ($item) {
                return '
                <div class="dropdown">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="actionDropdown' . $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i> Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="actionDropdown' . $item->id . '">
                        <a class="dropdown-item" href="#"><i class="fas fa-file-invoice-dollar text-dark"></i> &nbsp;View/Pay Invoice</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-edit text-dark"></i> &nbsp;Edit Invoice</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-credit-card text-dark"></i> &nbsp;Pay Invoice</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-check-circle text-dark"></i> &nbsp;Mark Paid</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-trash text-dark"></i> &nbsp;Delete Invoice</a>
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

    // Store a new invoice (demo data)
    public function store(Request $request)
    {
        $invoice = Invoices::create([
            'amount' => 100.00,
            'status' => 'pending',
        ]);
        return response()->json($invoice);
    }

    // Update an invoice (demo data)
    public function update(Request $request, $id)
    {
        $invoice = Invoices::findOrFail($id);
        $invoice->update([
            'amount' => 200.00,
            'status' => 'paid',
        ]);
        return response()->json($invoice);
    }

    // Delete an invoice
    public function destroy($id)
    {
        $invoice = Invoices::findOrFail($id);
        $invoice->delete();
        return response()->json(['message' => 'Invoice deleted']);
    }
}
