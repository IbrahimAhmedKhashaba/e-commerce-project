<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    //
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = ['name'];
    public $timestamps = false;

    public function getIsActiveAttribute($value){
        if(config('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
    
    public function governorates(){
        return $this->hasMany(Governorate::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
