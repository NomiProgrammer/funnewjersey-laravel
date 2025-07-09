<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
class BannersAds extends Model
{
    protected $table = 'banner';
    //
        public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
        public function customer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
        public function location()
    {
        return $this->belongsTo(Locations::class, 'state');
    }
}
