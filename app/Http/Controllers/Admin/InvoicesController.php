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
        $data = Invoices::select([
            'id',
            'total',
            'title',
            'description',
            'created_by',
            'assigned_to',
            'expires',
            'status'
        ]);

        return DataTables::of($data)->make(true);
    }

    return view('dashboard.admin.invoice.index'); // 👉 adjust your Blade path
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
