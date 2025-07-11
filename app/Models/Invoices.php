<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invoices extends Model
{
    protected $table = 'invoice';
    //
        protected $fillable = [
        'title',
        'description',
        'created_by',
        'status',
        'assigned_to',
        'total',
        'expires',
        'term',
    ];

    public $timestamps = false;
           public function customer()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
