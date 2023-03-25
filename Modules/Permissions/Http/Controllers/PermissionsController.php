<?php

namespace Modules\Permissions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Permissions\Services\DeletePermissionService;
use Modules\Permissions\Services\PermissionsService;
use Modules\Permissions\Services\StorePermissionService;
use Modules\Permissions\Services\SuperAdminService;
use Modules\Permissions\Services\UpdatePermissionService;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    public function index(Request $request,PermissionsService $service)
    {
        $permissions = $service->permissions($request->all());
        return view('permissions::permissions.index')->with('permissions',$permissions);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('permissions::create');
    }


    public function store(Request $request, StorePermissionService $service)
    {
        $request->validate([
            'name'=>'required|unique:permissions',
            'name_ar'=>'required|unique:permissions',
        ],[
            'name.required'=>__('Permission English name is required'),
            'name_ar.required'=>__('Permission Arabic name is required'),
            'name.unique'=>__('Permission English name is already taken'),
            'name_ar.unique'=>__('Permission Arabic name is already taken'),
        ]);

        $service->store_permission($request->all());
        session()->put('success',__('Permission Created Successfully'));
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('permissions::show');
    }


    public function edit(Permission $permission)
    {
        return view('permissions::modals.update_modal')->with('permission',$permission);
    }


    public function update(Request $request, Permission $permission,UpdatePermissionService $service)
    {
        $request->validate([
            'name_ar'=>'required|unique:permissions',
        ],[
            'name_ar.required'=>__('Permission Arabic name is required'),
            'name_ar.unique'=>__('Permission Arabic name is already taken'),
        ]);

        $service->update_permission($permission,$request->all());
        session()->put('success',__('Permission Updated Successfully'));
        return redirect()->back();
    }


    public function destroy(Permission $permission,DeletePermissionService $service)
    {
//        $service->delete_permission($permission);

        $permission->delete();
        session()->put('success',__('Permission Deleted Successfully'));
        return redirect()->back();
    }


}
