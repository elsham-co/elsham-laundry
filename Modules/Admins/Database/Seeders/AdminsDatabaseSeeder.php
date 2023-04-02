<?php

namespace Modules\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AdminsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $user = new User();
        $user->fill([
            'full_name' => 'Aboud Emil',
            // 'last_name' => '',
            'username' => 'aboud',
            'email' => 'aboud@elsham.com',
            'password' => '12345678',
            'phone'=> '01003922239',
            'active' => 1,
            'created_by' => 1
        ]);
        $user->save();
        $user->syncRoles(['admin']);
        // ===========================
        Model::unguard();
        $user = new User();
        $user->fill([
            'full_name' => 'ibrahim elamawy',
            // 'last_name' => '',
            'username' => 'ibrahim',
            'email' => 'ibrahim@elsham.com',
            'password' => '87654321',
            'phone'=> '01110175209',
            'active' => 1,
            'created_by' => 1
        ]);
        $user->save();
        $user->syncRoles(['system manager']);
    }
}