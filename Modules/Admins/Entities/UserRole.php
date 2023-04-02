<?php


namespace Modules\Admins\Entities;

use Modules\Core\Entities\CoreModel;
use Modules\Core\Entities\LanguageAttributes;
use Spatie\Permission\Models\Role;

class UserRole extends CoreModel
{
    protected $table = 'model_has_roles';


    public function RoleLang($id)
    {
        if (LanguageAttributes::lang_code() =='ar') {
            $role = Role::whereIn('id', $id)->pluck('name_ar', 'name')->toArray();
        } else {
            $role = Role::whereIn('id', $id)->pluck('name', 'name')->toArray();
        }
        return $role;
    }
}