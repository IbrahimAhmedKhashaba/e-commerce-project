<?php

namespace App\Services\Auth;

use App\Notifications\Dashboard\Auth\SendResetPasswordNotification;
use App\Repositories\Auth\PasswordRepository;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    protected $passwordRepository;
    public function __construct(PasswordRepository $passwordRepository)
    {
        //
        $this->passwordRepository = $passwordRepository;
    }

    public function send_otp($email)
    {
        $admin = $this->passwordRepository->send_otp($email);
        if (!$admin) {
            return false;
        }
        $admin->notify(new SendResetPasswordNotification());
        return $admin;
    }

    public function verify($email, $code)
    {
        $otp = $this->passwordRepository->verify($email, $code);
        return $otp->status;
    }

    public function reset($column, $email, $password)
    {
        return $this->passwordRepository->reset($column, $email, $password);
    }
}
