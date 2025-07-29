<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BlogArticle extends Model
{
     use SoftDeletes; // ✅ Add this
    protected $table = 'blog';
    //
        protected $fillable = [
        'type',
        'category',
        'title',
        'bmetatitle',
        'bmetadescription',
        'pageh1',
        'price',
        'shipping',
        'description',
        'featured_img',
        'created_by',
        'create_time'
    ];
    public $timestamps = false;
}
