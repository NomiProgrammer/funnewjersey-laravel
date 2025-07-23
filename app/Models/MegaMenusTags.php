<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegaMenusTags extends Model
{
    protected $table = 'metas';
    //
        protected $fillable = [
        'category',
        'county',
        'city',
        'region',
        'disableh1',
        'h1',
        'metatitle',
        'metadesc',
        'metakeywords',
        'pagetop',
        'pagebottom',
    ];
        public $timestamps = false;

        public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category');
    }
            public function location()
    {
        return $this->belongsTo(Locations::class, 'county');
    }
}
