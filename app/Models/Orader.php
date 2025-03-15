<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orader extends Model
{
    //
    protected $fillable = [
        'user_id',

        'user_name',
        'user_phone',
        'user_email',

        'price',
        'shipping_price',
        'total_price',

        'note',
        'status',

        'country',
        'governorate',
        'city',
        'street'
    ];
}
