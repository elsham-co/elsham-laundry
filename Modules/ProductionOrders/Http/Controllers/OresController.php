<?php

namespace Modules\ProductionOrders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionOrders\Entities\Ores_Recipt;
use Modules\ProductionOrders\Services\Ores_Recipt\OresReciptServices;
use Modules\ProductionOrders\Services\Ores_Recipt\StoreOresReciptService;
use Modules\ProductionOrders\Services\Ores_Recipt\EditOresorderServices;
use Modules\ProductionOrders\Services\Ores_Recipt\PrintServices;


class OresController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,OresReciptServices $service)
    {
   
        $Oresorders = $service->get_Oresorder($request->all());
        $CustomerName  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();
        $OresReceiver = $service->getMaterialReceiver();
        $UsersName=$service->getUserName();
        // $count_unDelivered = $service->count_unDelivered($request->all());
        // $countsampleinlab = $service1->count_SampleStelinLab($request->all());
        if($request->ajax()){
            return view('productionorders::oresreceipt/ores_order_table')->with('Oresorders',$Oresorders);
        }
        return view('productionorders::oresreceipt.index')->with('Oresorders',$Oresorders)
        ->with('CustomerName',$CustomerName)->with('FabricName',$FabricName)
        ->with('UsersName',$UsersName)->with('OresReceiver',$OresReceiver);
      
        // return $OresReceiver;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(OresReciptServices $service)
    {
        $CustomerName1  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();

        return view('productionorders::oresreceipt.create')->with('CustomerName1',$CustomerName1)
        ->with('FabricName',$FabricName);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request,StoreOresReciptService $service,OresReciptServices $service1)
    {
    
        
        $request->validate([
            'customer_code'=>['required'],
            'fabrics_code'=>['required'],
            'material_number'=>['required','max:5'],
            'materials_receiver'=>['required'],
            'materials_notes'=>['max:127']

        ],[

            'customer_code.required'=>__('Customer Name is Required Field...Please Add Customer Name'),

            'fabrics_code.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'material_number.required'=>__('Material Number is Required Field...Please Add Material Number'),
            'material_number.max'=>__('Sorry...it is allowed to enter 5 digtes in Material Number'),

            'materials_receiver.required'=>__('Materials Receiver is Required Field...Please Add Materials Receiver'),
            'materials_notes.max' =>__('Sorry...it is allowed to enter 127 characters in Materials Notes'),
        ]);

        $service->store_ores_order($request->all());
     
        session()->put('success',__('Ores Receipt Created Successfully'));
        $OresOrderID = $service1->getOresID();

        return redirect()->route('oresreceipt.viewcode', [$OresOrderID]);
    }

    public function vieworescode($OresOrderID,EditOresorderServices $service)
    {
        $OresOrder = $service->editOresorder($OresOrderID);
        return view('productionorders::oresreceipt.Oresid_code')->with('OresOrder',$OresOrder);

        // return $OresOrder;
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
    public function printOres($order,PrintServices $service)
    {
        $OresPrint = $service->printOrder($order);
        return view('productionorders::oresreceipt\print_ores')->with('OresPrint',$OresPrint);
        // return redirect(route('oresreceipt.print').'#tab2')->with('OresPrint',$OresPrint);
    //    return $OresPrint;
    }
}
