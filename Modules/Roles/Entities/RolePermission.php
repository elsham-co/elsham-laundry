<?php


namespace Modules\Roles\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\LanguageAttributes;
use Spatie\Permission\Models\Permission;

class RolePermission extends Model
{
    protected $table = 'role_has_permissions';

    public function permissionLang($permissions){
        if(LanguageAttributes::lang_code() == 'en'){
            $permission = Permission::whereIn('id',$permissions)->pluck('name','name')->toArray();
        }
        if(LanguageAttributes::lang_code() == 'ar'){
            $permission = Permission::whereIn('id',$permissions)->pluck('name_ar','name')->toArray();
        }
        return $permission;
    }

}
