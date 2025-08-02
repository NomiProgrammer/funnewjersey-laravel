<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    public $timestamps = false;
     public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice');
    }
}
