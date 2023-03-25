<?php


namespace Modules\Admins\Services;


use Modules\Admins\Repositories\UserRepositoryEloquent;
use Modules\Admins\Repositories\UserRoleRepositoryEloquent;

class UpdateAdminService
{

    public $user;
    public $userRole;


    public function __construct(UserRepositoryEloquent $user,UserRoleRepositoryEloquent $userRole)
    {
        $this->user = $user;
        $this->userRole = $userRole;

    }

    public function update_user($admin,$data)
    {


        $admin->update([
            'full_name'=>$data['full_name'],
            'username'=>$data['username'],
            'phone'=>$data['phone'],
            'password'=>$data['password'],
        ]);

        if(!empty($data['roles'])){
            $admin->syncRoles($data['roles']);
        }
    }

}
