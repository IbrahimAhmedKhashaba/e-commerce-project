<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Services\Auth\PasswordService;

class ResetPasswordController extends Controller
{
    //
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function getEmail()
    {
        return view('dashboard.auth.password.email');
    }

    public function send_otp(ForgetPasswordRequest $request)
    {
        $admin = $this->passwordService->send_otp($request->email);
        if (!$admin) {
            return redirect()->back()->withErrors(['email' => __('auth.email_not_found')]);
        }
        return redirect()->route('dashboard.password.confirm', $admin->email);
    }

    public function getConfirmForm($email)
    {
        return view('dashboard.auth.password.confirm', ['email' => $email]);
    }

    public function verify(ForgetPasswordRequest $request)
    {
        $otp = $this->passwordService->verify($request->email, $request->code);
        if (!$otp) {
            return redirect()->back()->withErrors(['code' => 'Code is not valid']);
        }
        return redirect()->route('dashboard.password.showUpdateForm', $request->email);
    }

    public function showUpdateForm($email)
    {
        return view('dashboard.auth.password.reset', ['email' => $email]);
    }
    public function reset(ForgetPasswordRequest $request)
    {
        if(!$this->passwordService->reset('email', $request->email, $request->password)){
            return redirect()->back()->withErrors(['error' => __('auth.failed')]);
        }
        return redirect()->route('dashboard.login.form');
    }
}
