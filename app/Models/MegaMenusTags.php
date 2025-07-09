<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegaMenusTags extends Model
{
    protected $table = 'metas';
    //
        public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
            public function location()
    {
        return $this->belongsTo(Locations::class, 'county');
    }
}
