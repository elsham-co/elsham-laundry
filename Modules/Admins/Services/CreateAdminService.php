<?php


namespace Modules\Admins\Services;


use Modules\Admins\Repositories\UserRoleRepositoryEloquent;
use Modules\Core\Entities\LanguageAttributes;
use Spatie\Permission\Models\Role;

class CreateAdminService
{
    public $user_role;

    public function __construct(UserRoleRepositoryEloquent $user_role)
    {
        $this->user_role = $user_role;

    }


    public function create_admin()
    {
        $allRoles =  Role::pluck('id')->toArray();
        $roles = $this->user_role->roleLang($allRoles);

        return $roles;

    }

}
