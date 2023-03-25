<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\User;
use Modules\Customers\Services\CustomerTypeService;


class UpdateTypeController extends Controller
{

    public function updateType(User $user,Request $request,CustomerTypeService $service)
    {

        $service->changeTypeCustomer($user,$request->all());
        session()->put('success',__('Customer type updated Successfully'));
        return redirect()->back();
    }


}
