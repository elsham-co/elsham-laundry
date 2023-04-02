<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Services\LoginService;
use Modules\Auth\Services\LogoutService;
use Modules\Auth\Services\ProfileService;
use Modules\Auth\Services\UpdateProfileService;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }


    public function login(Request $request, LoginService $service)
    {
       $auth =  $service->login($request->only('email','password','remember_me'));


       if($auth == 'notValid'){
            session()->put('error',__('Data Not Valid'));
            return redirect()->back();
        }
        else{
            session()->put('success',__('Logged in Successfully'));
            return redirect(route('dashboard'));
        }
    }
    public function logout(LogoutService $service)
    {
        $service->logout();
        session()->put('success',__('Logged out Successfully'));
        return redirect(route('login'));
    }

    public function profile(ProfileService $service)
    {

       $user =  $service->get_user_data();
        return view('auth::profile')->with('user',$user);
    }

    public function update_profile(Request $request, UpdateProfileService $service)
    {
        $request->validate([
            'full_name'=>'required',
            // 'last_name'=>'required',
            'username'=>'required',
            'old_password'=>'required_with:password',
        ]);


        $user = $service->update_profile($request->all());

        if($user == false){
            session()->put('errors',__('Old Password Not Correct'));
            return redirect()->back();

        }else{
            session()->put('success',__('Profile Updated Successfully'));
            return redirect()->back();

        }



    }

}
