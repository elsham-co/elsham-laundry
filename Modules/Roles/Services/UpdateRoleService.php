<?php


namespace Modules\Roles\Services;


use Modules\Roles\Repositories\UserRepositoryEloquent;
use Modules\Roles\Repositories\UserRoleRepositoryEloquent;

class UpdateRoleService
{
    public $user;
    public $user_role;

    public function __construct(UserRepositoryEloquent $user,UserRoleRepositoryEloquent $user_role)
    {
        $this->user = $user;
        $this->user_role = $user_role;
    }

    public function updateRole($role,$data)
    {

        $role->update([
            'name'=>$data['name'],
            'name_ar'=>$data['name_ar'],
        ]);

        $role->syncPermissions($data['permissions']);
        $this->user_role->where('role_id',$role->id)->delete();
        if(!empty($data['users'])){

            foreach($data['users'] as $user){
                $singleUser = $this->user->where('id',$user)->first();
                $singleUser->syncRoles($role->name);
                // $singleUser->assignRole($role->name);
            }
        }
    }

}
