<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    //

    use HasTranslations , Sluggable;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'slug' , 'status' , 'parent'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => \Carbon\Carbon::parse($value)->diffForHumans(),
        );
    }

    public function getStatusAttribute($value){
        if(config('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }

    public function scopeActive($query){
        return $query->where('status' , 1);
    }

    public function scopeInActive($query){
        return $query->where('status' , 0);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent');
    }


    public function parent(){
        return $this->belongsTo(Category::class , 'parent');
    }
}
