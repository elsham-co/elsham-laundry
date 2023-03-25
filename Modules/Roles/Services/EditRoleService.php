<?php


namespace Modules\Roles\Services;


use Modules\Core\Entities\LanguageAttributes;
use Modules\Roles\Repositories\GroupRepositoryEloquent;
use Modules\Roles\Repositories\UserGroupRepositoryEloquent;
use Modules\Roles\Repositories\UserRepositoryEloquent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRoleService
{
    // public $group;
    // public $user_group;
    public $user;

    // public function __construct(GroupRepositoryEloquent $group,UserGroupRepositoryEloquent $user_group,UserRepositoryEloquent $user)
    public function __construct(UserRepositoryEloquent $user)
    {
        // $this->group = $group;
        // $this->user_group = $user_group;
        $this->user = $user;
    }

    public function edit_role($role)
    {
        $data = [];

        $data['role'] = $role;

        $data['selected_permissions'] = $role->permissions->pluck('id');
        $data['selected_users'] = $this->user->role($role->name)->get();
        
        $manauth = auth()->user()->roles->map->name[0] ?? '';

        
        if ($manauth != 'system manager'){
        $permissions = Permission::where('name','!=','permissions')->get();
        foreach($permissions as $permission)
        {
            if(LanguageAttributes::lang_code() == 'en'){
                $permission->permission_name = $permission->name;
            }
            if(LanguageAttributes::lang_code() == 'ar'){
                $permission->permission_name = $permission->name_ar;
            }
        }
        $data['permissions'] = $permissions;

        $users = $this->user->get();
        $data['users'] = $users;

        return $data;   

    }else if($manauth == 'system manager'){
        // $permissions = Permission::where('name','!=','dashboard')->get();
        $permissions = Permission::get();
        foreach($permissions as $permission)
        {
            if(LanguageAttributes::lang_code() == 'en'){
                $permission->permission_name = $permission->name;
            }
            if(LanguageAttributes::lang_code() == 'ar'){
                $permission->permission_name = $permission->name_ar;
            }
        }
        $data['permissions'] = $permissions;
        $users = $this->user->get();
        $data['users'] = $users;

        return $data; 
    }
   

    }
}
