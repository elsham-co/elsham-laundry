<?php


namespace Modules\Auth\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;
use Modules\Auth\Repositories\UserRepositoryEloquent;

class UpdateProfileService
{

    public $user;

    public function __construct(UserRepositoryEloquent $userRepositoryEloquent)
    {
        $this->user = $userRepositoryEloquent;
    }

    public function update_profile($data)
    {

        $user =$this->user->find(Auth::user()->id);

        if(Hash::check($user->password , bcrypt($data['old_password']))){
            return false;
        }

        $user->update([
            'username'=>$data['username'],
            'full_name'=>$data['full_name'],
            // 'last_name'=>$data['last_name'],
            // 'password'=>bcrypt($data['password']),
            'password'=>$data['password'],
            'updated_by'=>auth()->user()->id,
            'updated_at'=>now()
        ]);

        return $user;
    }
}
