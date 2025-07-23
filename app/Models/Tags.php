<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    //
        protected $fillable = [
        'title',
        'parent',
        'metatitle2',
        'metakeywords2',
        'metadescription2',
        'catdesc',
        'catdesc2',
        'created_by',
        'create_time',
    ];
        public $timestamps = false;
}
