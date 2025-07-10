<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    //
        protected $fillable = [
        'alias',
        'show_in_menu',
        'layout',
        'content_from',
        'title',
        'url',
        'content',
        'seo_settings',
        'status',
        'create_time',
    ];

    public $timestamps = false; // if you use create_time manually
}
