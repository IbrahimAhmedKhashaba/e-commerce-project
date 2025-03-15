<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPreview extends Model
{
    //
    protected $fillable = [
        'comment',
        'product_id',
        'user_id',
    ];
}
