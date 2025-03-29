<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

use function PHPSTORM_META\type;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
        ];
    }

    public function hasAccess($config_permission)  // products , users , admins
    {
return true;

        // $role = $this->role;

        // if(!$role){
        //     return false;
        // }
        // if(in_array( $config_permission , json_decode($role->permissions))){
        //     return true;
        // }
        // return false;
    }


    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value == 1 ? 'Active' : 'Inactive',
        );
    }

    public function role(){
        return $this->belongsTo(Role::class , 'role_id');
    }
}
