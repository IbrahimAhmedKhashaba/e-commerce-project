<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OraderItem extends Model
{
    //
    protected $fillable = [
        'order_id',
        'product_id',

        'product_name',
        'product_desc',
        'product_quantity',
        'product_price',
        'data'
    ];
}
