<?php

namespace Modules\Admins\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Services\AdminsService;
use Modules\Admins\Services\CreateAdminService;
use Modules\Admins\Services\DeleteAdminService;
use Modules\Admins\Services\EditAdminService;
use Modules\Admins\Services\StoreAdminService;
use Modules\Admins\Services\UpdateAdminService;

class AdminsController extends Controller
{

    public function index(Request $request,AdminsService $service)
    {
        $admins = $service->admins($request->all());

        if($request->ajax()){
            return view('admins::admins/table')->with('admins',$admins);

        }
            return view('admins::admins.index')->with('admins',$admins);

    }


    public function create(CreateAdminService $service)
    {
        $roles = $service->create_admin();
        return view('admins::admins.create')->with('roles',$roles);
    }


    public function store(Request $request,StoreAdminService $service)
    {
        $request->validate([
            'username'=>['required','max:63','unique:users'],
            'full_name'=>'required',
            'email'=>'required|unique:users',
            'password'=>['required','max:63'],

            'roles'=>'required'
        ],[
            'username'=>__('Username is required'),
            'username.max'=>__('Sorry...it is allowed to enter 63 characters in UserName'),
            'username.unique'=>__('Username is Unique Field, Please Add Correct Username'),
            'full_name'=>__('Full Name is Required'),
            'email'=>__('email is required'),
            'email.unique'=>__('email is Unique Field, Please Add Correct email'),
            'password.required'=>__('password is required'),
            'password.max'=>__('Sorry...it is allowed to enter 63 characters in Password'),
            
            'roles'=>__('Role is required'),
        ]);


        $service->store_user($request->all());
        session()->put('success',__('Admin Created Successfully'));
        return redirect()->back();

        // return $request->all();

    }



    public function edit(User $user,EditAdminService $service)
    {
        $admin = $service->edit_admin($user);
        return view('admins::admins.edit')->with('admin',$admin);
        // return auth()->user();
    }


    public function update(Request $request, User $user,UpdateAdminService $service)
    {
        $request->validate([
            'username'=>'required',
            'full_name'=>'required',
            'roles'=>'required|array',
            'roles.*'=>'required',
        ],[
            'username'=>__('Username is required'),
            'full_name'=>__('Full Name is Required'),
            'roles.required'=>__('Role is required'),
        ]);


        $service->update_user($user,$request->all());
        session()->put('success',__('Admin Updated Successfully'));
        return redirect()->back();
    }


    public function destroy(User $user,DeleteAdminService $service)
    {
        $service->delete_admin($user);
        session()->put('success',__('Admin deleted Successfully'));
        return redirect()->back();
    }
}
