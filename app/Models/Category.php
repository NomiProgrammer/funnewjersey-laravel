<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    //
        protected $fillable = [
        'title',
        'minititle',
        'url',
        'not_public',
        'noh1',
        'islink',
        'countoverride',
        'parent',
        'fa_icon',
        'metatitle2',
        'metakeywords2',
        'metadescription2',
        'catdesc',
        'catdesc2',
        'metatitle',
        'metakeywords',
        'metadescription',
        'catdescvar',
        'catdesc2var',
        'featured_img',
        'img_alt',
        'featured_img2',
        'img_alt2',
        'featured_img3',
        'img_alt3',
        'created_by',
        'create_time',
    ];

    public $timestamps = false;
    public function parentCategory()
{
    return $this->belongsTo(Category::class, 'parent');
}

public function children()
{
    return $this->hasMany(Category::class, 'parent');
}

}
