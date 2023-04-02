<?php


namespace Modules\Permissions\Services;


use Spatie\Permission\Models\Permission;

class StorePermissionService
{
    public function store_permission($data)
    {
        $permission  = Permission::create([
            'name'=>$data['name'],
            'name_ar'=>$data['name_ar'],
            'guard_name'=>'web',
        ]);

    }
}
