<?php


namespace Modules\Auth\Services;


use Illuminate\Support\Facades\Auth;

class LogoutService
{
    public function logout()
    {
        Auth::logout();
    }
}
