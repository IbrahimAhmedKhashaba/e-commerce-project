<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    //
    use HasTranslations;
    public $translatable = ['role'];
    protected $fillable = ['role', 'permissions'];
}
