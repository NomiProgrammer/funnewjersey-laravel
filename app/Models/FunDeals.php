<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunDeals extends Model
{
    protected $table = 'blog';
    //
        protected $fillable = [
        'type',
        'title',
        'price',
        'deal_limit',
        'description',
        'featured_img',
        'terms',
        'created_by',
        'create_time',
        'status'
    ];
    public $timestamps = false;
}
