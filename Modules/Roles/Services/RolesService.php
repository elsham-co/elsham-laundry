<?php


namespace Modules\Roles\Services;


use Modules\Core\Entities\LanguageAttributes;
use Modules\Roles\Repositories\UserRoleRepositoryEloquent;
use Spatie\Permission\Models\Role;

class RolesService
{
    public $userRole;

    public function __construct(UserRoleRepositoryEloquent $userRole)
    {
        $this->userRole = $userRole;
    }

    public function roles($data = null)
    {
        if (isset($data['search'])) {

            $roles = Role::where('name','LIKE','%'.$data['search'].'%')->orWhere('name_ar','LIKE','%'.$data['search'].'%')->Paginate(10);
        } else {
            $roles = Role::Paginate(10);
        }


        
        foreach ($roles as $role) {

            $checkRole = $this->userRole->where('role_id', $role->id)->get();
            if ($checkRole->count() > 0) {
                $role->delete = 0;
            } else {
                $role->delete = 1;
            }
            if (LanguageAttributes::lang_code() == 'ar') {
                $role->role_name = $role->name_ar;
            } else {
                $role->role_name = $role->name;
            }
        }
        return $roles;
    }


}
