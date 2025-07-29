<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostPackage extends Model
{
    //
    public function invoice()
{
    return $this->belongsTo(Invoices::class);
}
}
