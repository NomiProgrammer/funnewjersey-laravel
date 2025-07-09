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
    //
    public function customer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
