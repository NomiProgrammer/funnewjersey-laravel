<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Parallax;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Category;
class Parallax extends Model
{
    protected $table = 'slider';

    // Fillable fields
    protected $fillable = [
        'title',
        'link',
        'alttag',
        'button',
        'starts',
        'expires',
        'category',
        'county',
        'city',
        'description',
        'created_by',
        'featured_img',
        'slide_order',
        'create_time'
    ];
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function location()
    {
        return $this->belongsTo(Locations::class, 'city');
    }
    public function country()
    {
        return $this->belongsTo(Locations::class, 'county');
    }
}
