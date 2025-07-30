<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPackage extends Model
{
    //
    protected $table = 'post_package';

        protected $fillable = [
        'unique_id',
        'post_id',
        'package_id',
        'amount',
        'request_date',
        'activation_date',
        'expiration_date',
        'is_active',
        'status',
        'payment_medium',
        'payment_type',
        'response_log',
        'invoice_id',
        'assigned_to',
    ];
    public $timestamps = false;

    public function invoice()
{
    return $this->belongsTo(Invoices::class);
}
}
