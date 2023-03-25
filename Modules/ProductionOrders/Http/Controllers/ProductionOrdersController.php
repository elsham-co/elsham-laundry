<?php

namespace Modules\ProductionOrders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionOrders\Entities\Orders;

use Modules\ProductionOrders\Services\orders\OrdersServices;
class ProductionOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('productionorders::orders.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(OrdersServices  $service)
    {
        $CustomerName1  = $service->getCustomerName();
        $CustomerID =$service->getCustomerID();
        $FabricName  = $service->getFabricName();
        $FabricID =$service->getFabricID();
        $ColorsName  = $service->getColorName();
        $FashionsName  = $service->getFashionName();
        $ThreadName = $service->getThreadName();
        return view('productionorders::orders.create')->with('CustomerName1',$CustomerName1)->with('CustomerID',$CustomerID)
        ->with('FabricName',$FabricName)->with('FabricID',$FabricID)->with('ThreadName',$ThreadName)
        ->with('ColorsName',$ColorsName)
        ->with('FashionsName',$FashionsName);
        // return view('productionorders::orders.create');
        // return $CustomerName1;
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
        return view('productionorders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('productionorders::edit');
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
}
