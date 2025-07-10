<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table = 'packages';
    //
            protected $fillable = [
        'type',
        'title',
        'description',
        'price',
        'expiration_time',
        'status',
    ];
      public $timestamps = false; // ✅ Turn off timestamps!

}
