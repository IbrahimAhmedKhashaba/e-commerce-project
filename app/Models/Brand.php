<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;


class Brand extends Model
{
    //
    use HasTranslations , Sluggable;

    public $translatable = ['name'];
    protected $fillable = ['name' , 'logo' , 'status'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
