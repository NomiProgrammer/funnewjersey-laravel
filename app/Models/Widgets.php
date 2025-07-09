<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
    protected $table = 'widgets';
    //
        protected $fillable = [
        'name',
        'alias',
        'status',
        'editable',
    ];
      public $timestamps = false; // ✅ Turn off timestamps!
}
