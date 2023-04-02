<?php


namespace Modules\Admins\Services;

use Modules\Admins\Repositories\UserRepositoryEloquent;

class StoreAdminService
{
    public $user;

    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
    }

    public function store_user($data)
    {
        $user =  $this->user->create([
            'full_name'=>$data['full_name'],
            'username'=>$data['username'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'password'=> $data['password'],
            'active'=>1,
            'created_by'=>auth()->user()->id,
            'created_at'=>now()
        ]);

        if (!empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }
        $user->givePermissionTo('dashboard');
    }
}