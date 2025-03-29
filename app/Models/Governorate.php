<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Governorate extends Model
{
    //
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'country_id'];
    public $timestamps = false;

    public function getIsActiveAttribute($value){
        if(config('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
    
    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function cities(){
        return $this->hasMany(City::class , 'governorate_id');
    }

    public function shippingPrice(){
        return $this->hasOne(ShippingGovernorate::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
