<?php


namespace Modules\Admins\Services;


use Modules\Admins\Repositories\UserRoleRepositoryEloquent;
use Modules\Core\Entities\LanguageAttributes;
use Spatie\Permission\Models\Role;

class EditAdminService
{
    public $user_role;

    public function __construct(UserRoleRepositoryEloquent $user_role)
    {
        $this->user_role = $user_role;

    }

    public function edit_admin($admin)
    {
        $admin_roles = $this->user_role->where('model_id',$admin->id)->pluck('role_id')->toArray();
        $role = $this->user_role->roleLang($admin_roles);
        $admin->role = $role;
        $allRoles =  Role::pluck('id')->toArray();
        $roles = $this->user_role->roleLang($allRoles);
        $admin->roles = $roles;
        return $admin;
    }

}
