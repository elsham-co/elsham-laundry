<?php


namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Auth\Repositories\UserRepositoryEloquent;

class LoginService
{
    public $user_repository;

    public function __construct(
        UserRepositoryEloquent $userRepositoryEloquent
    ) {
        $this->user_repository = $userRepositoryEloquent;
    }


    public function login($data)
    {
        $user = $this->user_repository->where(function ($query) use ($data) {
            $query->where('email', $data['email'])
                ->orWhere('username', $data['email'])
                ->orWhere('phone', $data['email']);
        })->where('active', 1)->first();
            
        if (isset($user)) {
            $remember_me = isset($data['remember_me']) ? true : false;
            if (Auth::attempt(
                ['email'=>$data['email'],
                'password'=>$data['password']],
                $remember_me
            )) {
                return 'valid';
            } elseif (Auth::attempt(
                ['username'=>$data['email'],
                'password'=>$data['password']],
                $remember_me
            )) {
                return 'valid';
            } elseif (Auth::attempt(
                ['password'=>$data['password'],
                'phone'=>$data['email']],
                $remember_me
            )) {
                return 'valid';
            } else {
                return 'notValid';
            }
        }

        return 'notValid';
    }
}