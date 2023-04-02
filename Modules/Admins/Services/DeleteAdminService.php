<?php


namespace Modules\Admins\Services;


use Modules\Admins\Repositories\UserGroupRepositoryEloquent;
use Modules\Admins\Repositories\UserRoleRepositoryEloquent;

class DeleteAdminService
{
    // public $user_group;
    public $role;

    // public function __construct(UserGroupRepositoryEloquent $user_group,UserRoleRepositoryEloquent $role)
    public function __construct(UserRoleRepositoryEloquent $role)
    {
        // $this->user_group = $user_group;
        $this->role = $role;
    }

    public function delete_admin($admin)
    {
        // $this->user_group->where('user_id',$admin->id)->delete();

        $this->role->where('model_id',$admin->id)->delete();
        $admin->delete();
    }

}
