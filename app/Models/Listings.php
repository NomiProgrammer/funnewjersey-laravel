<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'posts';
    //
        public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
