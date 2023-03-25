<?php


namespace Modules\Permissions\Services;


use Modules\Core\Entities\LanguageAttributes;
use Spatie\Permission\Models\Permission;

class PermissionsService
{
    public function permissions($data = null)
    {

        if (isset($data['search'])) {
            $permissions = Permission::where('name','LIKE','%'.$data['search'].'%')->orWhere('name_ar','LIKE','%'.$data['search'].'%')->Paginate(20);
        } else {
            $permissions = Permission::Paginate(20);
        }


        foreach ($permissions as $permission){
            if(LanguageAttributes::lang_code() =='ar'){
                $permission->permission_name = $permission->name_ar;
            }else{
                $permission->permission_name = $permission->name;
            }
        }
        return $permissions;
    }
}
