<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function assign_permissions_to_super_admin()
    {
        $user =User::where('email','amgad@beljoumla.com')->first();
        $permissions = Permission::pluck('name')->toArray();
        $user->syncPermissions($permissions);
    }
}
