<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = ['site_name', 'site_phone', 'site_address', 'site_email', 'email_support', 'facebook_url', 'twitter_url', 'youtube_url', 'logo', 'favicon'];
    public $timestamps = false;
}
