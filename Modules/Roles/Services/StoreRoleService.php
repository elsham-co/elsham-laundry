<?php


namespace Modules\Roles\Services;


use Modules\Roles\Repositories\UserRepositoryEloquent;
use Spatie\Permission\Models\Role;

class StoreRoleService
{
    public $user;

    public function __construct(UserRepositoryEloquent $user)
    {
        $this->user = $user;
    }


    public function store_role($data)
    {

        $role = Role::create([
            'name'=>$data['name'],
            'name_ar'=>$data['name_ar'],
            'guard_name'=>'web',
        ]);

        $role->syncPermissions($data['permissions']);

        if(!empty($data['users'])){
            foreach($data['users'] as $user){
                $singleUser = $this->user->where('id',$user)->first();
                $singleUser->assignRole($role->name);
            }
        }


    }

}
