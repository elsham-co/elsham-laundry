<?php


namespace Modules\Auth\Services;


use Illuminate\Support\Facades\Auth;
use Modules\Auth\Repositories\UserRepositoryEloquent;

class ProfileService
{
    public $user;

    public function __construct(UserRepositoryEloquent $userRepositoryEloquent)
    {
        $this->user = $userRepositoryEloquent;
    }

    public function get_user_data()
    {
        return  Auth::user();
    }

}
