<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\DB;

class PasswordRepository
{
    protected $otp;
    public function __construct(Otp $otp){
        $this->otp = $otp;
    }
    public function send_otp($email){
        return Admin::where('email', $email)->first();
    }

    public function verify($email, $code){
        return $this->otp->validate($email , $code);
    }

    public function reset($column , $email, $password){
        if(DB::table('otps')->where('identifier' , $email)->where('valid' , 1)->first()){
            return false;
        }
        $admin = Admin::where($column , $email)->first();
        $admin->update(['password' => bcrypt($password)]);
        return $admin;
    }
}
