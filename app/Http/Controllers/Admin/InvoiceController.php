<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
public function payment(Request $request)
{
    $query = Payment::with('relatedInvoice')->orderBy('id', 'desc');

    if ($request->filled('fromdate') && $request->filled('todate')) {
        try {
            $from = Carbon::parse($request->fromdate)->startOfDay();
            $to = Carbon::parse($request->todate)->endOfDay();
            $query->whereBetween('paymentdate', [$from, $to]);
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid date format.');
        }
    }

    // if (auth()->user()->id != 1) {
    //     $query->whereHas('relatedInvoice', function ($q) {
    //         $q->where('assigned_to', auth()->user()->id);
    //     });
    // }

    $payments = $query->paginate(20);
    return view('dashboard.admin.invoice.payments', [
        'payments' => $payments,
        'fromdate' => $request->fromdate,
        'todate' => $request->todate,
    ]);
}

public function destroy(Payment $payment)
{
    $payment->delete();
    return back()->with('success', 'Payment deleted successfully.');
}

}
