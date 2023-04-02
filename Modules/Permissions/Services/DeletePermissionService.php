<?php


namespace Modules\Permissions\Services;


class DeletePermissionService
{
    public function delete_permission($permission)
    {
            $permission->delete();
    }

}
