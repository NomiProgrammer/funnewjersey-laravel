<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'blog';
    //
        protected $fillable = [
        'type',
        'title',
        'price',
        'shipping',
        'description',
        'featured_img',
        'created_by',
        'create_time'
    ];
    public $timestamps = false;
}
