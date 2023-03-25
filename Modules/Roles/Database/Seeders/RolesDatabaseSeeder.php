<?php

namespace Modules\Roles\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $role = new Role();
        $role->fill([
            'name' => 'admin',
            'name_ar' => __('admin'),
            'guard_name' => 'web'
        ]);
        $role->save();
        $role->syncPermissions(...[
            'dashboard', 'roles','create-role','update-role','delete-role', 'admins','create-admin',
            'update-admin','delete-admin','customers', 'orders','components', 'samples', 'inventory', 'ores_receipt'
            
        ]);
        // ================================
        Model::unguard();
        $role = new Role();
        $role->fill([
            'name' => 'system manager',
            'name_ar' => __('system manager'),
            'guard_name' => 'web'
        ]);
        $role->save();
        $role->syncPermissions(...[
            'dashboard', 'roles','create-role','update-role','delete-role', 'admins','create-admin',
            'update-admin','delete-admin','customers', 'orders','components', 'samples', 'inventory',
             'ores_receipt','permissions'
            
        ]);
    }
}