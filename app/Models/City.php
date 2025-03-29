<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    //
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'governorate_id'];
    public $timestamps = false;

    public function getIsActiveAttribute($value){
        if(config('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
    
    public function governorate(){
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
}
