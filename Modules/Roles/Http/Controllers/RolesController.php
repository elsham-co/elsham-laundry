<?php

namespace Modules\Roles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Permissions\Services\UpdatePermissionService;
use Modules\Roles\Services\CreateRoleService;
use Modules\Roles\Services\DeleteRoleService;
use Modules\Roles\Services\EditRoleService;
use Modules\Roles\Services\RolesService;
use Modules\Roles\Services\StoreRoleService;
use Modules\Roles\Services\UpdateRoleService;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function index(Request $request,RolesService $service)
    {
        $roles = $service->roles($request->all());
        if($request->ajax()){
            return view('roles::roles/role_table')->with('roles',$roles);
        }
        return view('roles::roles.index')->with('roles',$roles);
    }


    public function create(CreateRoleService $service)
    {
        $data = $service->create_role();

        return view('roles::roles.create')->with('data',$data);
    }


    public function store(Request $request, StoreRoleService $service)
    {
        $request->validate([
            'name'=>'required|unique:roles',
            'name_ar'=>'required|unique:roles',
            'permissions'=>'required|array',
            'permissions.*'=>'required',

        ],[
            'name.required'=>__('Role English name is required'),
            'name_ar.required'=>__('Role Arabic name is required'),
            'permissions.required'=>__('Permissions is required'),
            'name.unique'=>__('Role English name is already taken'),
            'name_ar.unique'=>__('Role Arabic name is already taken'),
        ]);

        $service->store_role($request->all());
        session()->put('success',__('Role Created Successfully'));
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('roles::show');
    }


    public function edit(Role $role,EditRoleService $service)
    {
        $data = $service->edit_role($role);

        return view('roles::roles.edit')->with('data',$data);
    // return $data;
    }


    public function update(Request $request, Role $role,UpdateRoleService $service)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$role->id,
            'name_ar'=>'required|unique:roles,name_ar,'.$role->id,
            'permissions'=>'required',
        ],[
            'name.required'=>__('Role English name is required'),
            'name_ar.required'=>__('Role Arabic name is required'),
            'permissions.required'=>__('Permissions is required'),
            'name.unique'=>__('Role English name is already taken'),
            'name_ar.unique'=>__('Role Arabic name is already taken'),
        ]);


       $service->updateRole($role,$request->all());
        session()->put('success',__('Role Updated Successfully'));
        return redirect()->back();
        // return $service;
    }


    public function destroy(Role $role,DeleteRoleService $service)
    {
        $service->delete($role);
        session()->put('success',__('Role Deleted Successfully'));
        return redirect()->back();
    }
}
