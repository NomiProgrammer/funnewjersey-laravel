<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegaMenus extends Model
{
    protected $table = 'menus';
    //
        protected $fillable = [
        'col1',
        'title',
        'col2',
        'col3',
        'col4',
        'col5',
        'col1a',
        'col2a',
        'col3a',
        'col4a',
        'col5a',
        'col6a',
        'col7a',
        'col8a',
        'featured_img',
        'featured_img2',
        'featured_img3',
        'featured_img4',
    ];
        public $timestamps = false;

}
