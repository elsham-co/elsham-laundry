<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\User;
use Modules\Customers\Services\CustomersOrdersService;

class CustomersOrdersController extends Controller
{

    public function index(User $user, Request $request,CustomersOrdersService $service)
    {
        $orders = $service->orders($user,$request->all());
        if($request->ajax()){
            return view('customers::order_table')->with('orders',$orders)->with('user',$user);
        }
        return view('customers::orders')->with('orders',$orders)->with('user',$user);
    }
}