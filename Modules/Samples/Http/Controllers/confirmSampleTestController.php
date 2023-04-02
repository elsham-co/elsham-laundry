<?php

namespace Modules\Samples\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Samples\Entities\SamplesOrder;
use Modules\Samples\Services\SamplesCreation\confirmSampleTestService;
use Modules\Samples\Services\Sampleorder\ConfirmFromLabDateService;
use Modules\Samples\Services\Sampleorder\DeliveredtocustomersService;
use Modules\Samples\Services\Sampleorder\SamplesOrderServices;



class confirmSampleTestController extends Controller
{

    public function confirm(Request $request,confirmSampleTestService $service)
    {

        $service->createSampleCode($request->all());
    //    return response()->json();

  

    }
    public function updateType($Sample_order,Request $request,ConfirmFromLabDateService $service,SamplesOrderServices $service1)
    {

        $service->updatefromlab_date($Sample_order,$request->all());
       session()->put('success',__('Samples Accepted From Lab Successfully'));
      
       $Sample_order = $service1->get_sampleorder($request->all());
       if($request->ajax()){
           return redirect()-> route('samples::SamplesOrder/sample_order_table')->with('Sample_order',$Sample_order);
       }
      
       return redirect()-> route('SamplesOrder.index')->with('Sample_order',$Sample_order);
    // return $request->all();
    }
    
    public function editdelivery($Sample_order){
        $bookData = SamplesOrder::find($Sample_order);
        return response()->json([
           'status' =>200,
           'bookdata' =>$bookData,
       ]);
    // return $bookData;
   }
    public function deliversample($Sample_order,Request $request,DeliveredtocustomersService $service,SamplesOrderServices $service1)
    {

        $service->updatedeliversample($Sample_order,$request->all());
       session()->put('success',__('Sample Delivered To Customer Successfully'));
      
       $Sample_order = $service1->get_sampleorder($request->all());
       if($request->ajax()){
           return redirect()-> route('samples::SamplesOrder/sample_order_table')->with('Sample_order',$Sample_order);
       }
      
       return redirect()-> route('SamplesOrder.index')->with('Sample_order',$Sample_order);
    // return $request->all();
    }
}
