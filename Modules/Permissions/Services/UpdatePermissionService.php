<?php


namespace Modules\Permissions\Services;


use Spatie\Permission\Models\Permission;

class UpdatePermissionService
{
    public function update_permission($permission,$data)
    {

        $permission->update(['name_ar'=>$data['name_ar']]);
    }
}
