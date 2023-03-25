<?php


namespace Modules\Roles\Services;


use Modules\Roles\Repositories\RolePermissionRepositoryEloquent;
use Modules\Roles\Repositories\UserRepositoryEloquent;
use Modules\Roles\Repositories\UserRoleRepositoryEloquent;

class DeleteRoleService
{

    public $user_role;
    public $role_permissions;

    public function __construct(UserRoleRepositoryEloquent $user_role,RolePermissionRepositoryEloquent $role_permissions)
    {
        $this->user_role = $user_role;
        $this->role_permissions = $role_permissions;
    }

    public function delete($role)
    {
        if($this->role_permissions->where('role_id',$role->id)->count() > 0){
            $this->role_permissions->where('role_id',$role->id)->delete();
        }

        $role->delete();
    }

}
