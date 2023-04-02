<?php

namespace Modules\Permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admins\Entities\UserRole;
use Spatie\Permission\Models\Permission;

class PermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $permissions = [
            'dashboard', 'roles','create-role','update-role','delete-role', 'admins','create-admin','update-admin','delete-admin',
             'customers', 'orders','components', 'samples', 'inventory', 'ores_receipt','permissions'
        ];

        foreach ($permissions as $permissionName) {
            $permission = new Permission();
            $permission->fill([
                'name' => $permissionName,
                'name_ar' => __($permissionName),
                'guard_name' => 'web'
            ]);
            $permission->save();
        }
    }
}