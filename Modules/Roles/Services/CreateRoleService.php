<?php


namespace Modules\Roles\Services;


use Modules\Core\Entities\LanguageAttributes;
use Modules\Roles\Repositories\GroupRepositoryEloquent;
use Modules\Roles\Repositories\RolePermissionRepositoryEloquent;
use Modules\Roles\Repositories\UserGroupRepositoryEloquent;
use Modules\Roles\Repositories\UserRepositoryEloquent;
use Spatie\Permission\Models\Permission;

class CreateRoleService
{
    public $group;
    public $user_group;
    public $user;
    public $rolePermission;

    // public function __construct(GroupRepositoryEloquent $group,UserGroupRepositoryEloquent $user_group,
    //                             UserRepositoryEloquent $user,RolePermissionRepositoryEloquent $rolePermission)
       public function __construct(UserRepositoryEloquent $user,RolePermissionRepositoryEloquent $rolePermission)
    {
        // $this->group = $group;
        // $this->user_group = $user_group;
        $this->user = $user;
        $this->rolePermission = $rolePermission;
    }

    public function create_role()
    {
        // $data = [];
        // $allPermissions = Permission::where('name','!=','dashboard')->pluck('id')->toArray();
        // $permissions = $this->rolePermission->permissionLang($allPermissions);
        // $data['permissions'] = $permissions;
        // $admin_group = $this->group->where('name','admin')->first();
        // $user_group = $this->user_group->where('group_id',$admin_group->id)->pluck('user_id')->toArray();
        // $users = $this->user->whereIn('id',$user_group)->get();
        // $data['users'] = $users;
        // return $data;
        $data = [];
        // $allPermissions = Permission::where('name','!=','dashboard')->pluck('id')->toArray();
        $allPermissions = Permission::pluck('id')->toArray();
        $permissions = $this->rolePermission->permissionLang($allPermissions);
        $data['permissions'] = $permissions;
        // $admin_group = $this->group->where('name','admin')->first();
        // $user_group = $this->user_group->where('group_id',$admin_group->id)->pluck('user_id')->toArray();
        $users = $this->user->get();
        $data['users'] = $users;
        return $data;
    }


}
