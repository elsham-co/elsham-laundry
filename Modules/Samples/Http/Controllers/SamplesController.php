<?php

namespace Modules\Samples\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Samples\Entities\SamplesOrder;
use Modules\Samples\Entities\SamplesOrderInfo;
use Modules\Samples\Services\Sampleorder\SamplesOrderServices;
use Modules\Samples\Services\Sampleorder\StoreSamplesOrderService;
use Modules\Samples\Services\Sampleorder\EditsampleorderServices;
use Modules\Samples\Services\Sampleorder\UpdateSamplesOrderService;
use Modules\Samples\Services\SamplesCreation\TestSamplesServices;
use Modules\Samples\Services\Sampleorder\SoftDeleteSampleorderServices;
use Modules\Samples\Services\Sampleorder\DeletedSampleOrderservice;


class SamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,SamplesOrderServices $service,TestSamplesServices $service1)
    {
   
        $sample_orders = $service->get_sampleorder($request->all());
        $count_unDelivered = $service->count_unDelivered($request->all());
        $countsampleinlab = $service1->count_SampleStelinLab($request->all());
         $CustomerName  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();
        // $OresReceiver = $service->getMaterialReceiver();
        $UsersName=$service->getUserName();
        if($request->ajax()){
            return view('samples::SamplesOrder/sample_order_table')->with('sample_orders',$sample_orders);
        }
        return view('samples::SamplesOrder.index')->with('sample_orders',$sample_orders)
        ->with('countsampleinlab',$countsampleinlab)->with('count_unDelivered',$count_unDelivered)
        ->with('CustomerName',$CustomerName)->with('FabricName',$FabricName)
        ->with('UsersName',$UsersName);
        // return view('samples::SamplesOrder.index');
        // return $sample_orders;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(SamplesOrderServices $service)
    {
        $CustomerName1  = $service->getCustomerName();
        $CustomerID =$service->getCustomerID();
        $fabCategoryName  = $service->getFabricsCategoryName();
        $FabricName  = $service->getFabricName();
        $FabricID =$service->getFabricID();
        $colCategoryName  = $service->getFabricsCategoryName();
        $ColorsName  = $service->getColorName();
        $ColorID =$service->getColorID();
        $FashionsName  = $service->getFashionName();
        $SampleOrderID = $service->getSampleOrderID();
        return view('samples::SamplesOrder.create')->with('SampleOrderID',$SampleOrderID)
        ->with('CustomerName1',$CustomerName1)->with('CustomerID',$CustomerID)
        ->with('FabricName',$FabricName)->with('FabricID',$FabricID)->with('fabCategoryName',$fabCategoryName)
        ->with('ColorsName',$ColorsName)->with('ColorID',$ColorID)->with('colCategoryName',$colCategoryName)
        ->with('FashionsName',$FashionsName);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request,StoreSamplesOrderService $service,SamplesOrderServices $service1)
    {
    
        
        $request->validate([
            'customer_code'=>['required'],
            'fabrics_code'=>['required'],
            'nopieces'=>['required'],
            'samplesnotes'=>['max:127']

        ],[

            'customer_code.required'=>__('Customer Name is Required Field...Please Add Customer Name'),

            'fabrics_code.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'nopieces.required'=>__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces'),
            'samplesnotes.max' =>__('Sorry...it is allowed to enter 127 characters in Samples Order Notes'),
        ]);

        $service->store_sample_order($request->all());
     
        session()->put('success',__('Samples Order Created Successfully'));
        $SampleOrderID = $service1->getSampleOrderID();

        return redirect()->route('SamplesOrder.samplecode', [$SampleOrderID]);
    }

    public function viewsamplecode($SampleOrderID,EditsampleorderServices $service)
    {
        $Sample_order = $service->editSampleorder($SampleOrderID);
        return view('samples::SamplesOrder/viewid_name')->with('Sample_order',$Sample_order);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($Sample_order,EditsampleorderServices $service,SamplesOrderServices $service1)
    {
        $CustomerName1  = $service1->getCustomerName();
        $FabricName  = $service1->getFabricName();
        $ColorsName  = $service1->getColorName();
        $FashionsName  = $service1->getFashionName();
        $Sample_order = $service->editSampleorder($Sample_order);
        return view('samples::SamplesOrder.edit')->with('Sample_order',$Sample_order)
        ->with('CustomerName1',$CustomerName1)
        ->with('FabricName',$FabricName)
        ->with('ColorsName',$ColorsName)
        ->with('FashionsName',$FashionsName);
        // return  $Sample_order;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,SamplesOrder $Sample_order ,UpdateSamplesOrderService $service
    ,SamplesOrderServices $service1)
    {
        $request->validate([
            'samplecode'=>['required'],
            'customer_code'=>['required'],
            'fabrics_code'=>['required'],
            'nopieces'=>['required'],
            'samplesnotes'=>['max:127']

        ],[
            'samplecode.required'=>__('SamplesOrder ID is Required Field...Please SamplesOrder ID'),

            'customer_code.required'=>__('Customer Name is Required Field...Please Add Customer Name'),


            'fabrics_code.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'nopieces.required'=>__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces'),
            'samplesnotes.max' =>__('Sorry...it is allowed to enter 127 characters in Samples Order Notes'),
        ]);

        $service->update_sample_order($Sample_order,$request->all());
        session()->put('success',__('Samples Order updated Successfully'));
       
        $Sample_order = $service1->get_sampleorder($request->all());
        if($request->ajax()){
            return redirect()-> route('samples::SamplesOrder/sample_order_table')->with('Sample_order',$Sample_order);
        }
       
        return redirect()-> route('SamplesOrder.index')->with('Sample_order',$Sample_order);
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($Sample_order,SoftDeleteSampleorderServices $service)
    {
        $service->softDelete_Sampleorder($Sample_order);
        session()->put('success',__('Color Deleted Successfully'));
        return redirect()->back();
        // return $Sample_order;
    }
    public function deletedsampleorder(Request $request,DeletedSampleOrderservice $service)
    {
   
        $sample_orders = $service->get_deletedsampleorder($request->all());
        if($request->ajax()){
            return view('samples::SamplesOrder/deleted_sampleorder_table')->with('sample_orders',$sample_orders);
        }
        return view('samples::SamplesOrder.deleted_sampleorder')->with('sample_orders',$sample_orders);

        // return $sample_orders;
    }
}
