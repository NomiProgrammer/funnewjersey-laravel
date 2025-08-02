<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'invoice_id',
        'paymentid',
        'amount',
        'paymentdate'
    ];

    /**
     * Get the invoice that owns the payment.
     */
    public function relatedInvoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
