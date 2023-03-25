<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerInfo;
use Modules\Customers\Entities\User;
use Modules\Customers\Services\CustomerStatusService;


class UpdateStatusController extends Controller
{

    public function updateStatus(User $user,Request $request,CustomerStatusService $service)
    {

        $service->updateStatus($user,$request->all());
        session()->put('success',__('Customer Status updated Successfully'));
        return redirect()->back();
    }


}
