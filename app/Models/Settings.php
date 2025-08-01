<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $table = "options";
            protected $fillable = [
        'key',
        'values',
    ];
        public $timestamps = false;
}
