<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invoices extends Model
{
    protected $table = 'invoice';
    //
           public function customer()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
