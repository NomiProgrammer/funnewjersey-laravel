<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
class BannersAds extends Model
{
    protected $table = 'banner';
    //
        protected $fillable = [
        'slide_order',
        'featured_img',
        'title',
        'description',
        'created_by',
        'create_time',
        'status',
        'state',
        'link',
        'slot',
        'category',
        'expires',
        'assigned_to',
        'type',
        'region',
    ];

    public $timestamps = false;
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
