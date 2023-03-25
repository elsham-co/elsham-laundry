<?php

namespace Modules\ProductionOrders\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionOrders\Entities\Store;
use Modules\ProductionOrders\Entities\Transaction;
use Modules\ProductionOrders\Services\pro_follow_up\Storepro_follow_upService;
use Modules\ProductionOrders\Services\pro_follow_up\Edit_follow_upServices;
use Modules\ProductionOrders\Services\pro_follow_up\Updatepro_follow_upService;
use Modules\ProductionOrders\Services\pro_follow_up\StoreRunningOrderService;
use Modules\ProductionOrders\Services\pro_follow_up\TransactionServices;
use Modules\ProductionOrders\Services\pro_follow_up\TransactionXlsxService;
use Modules\ProductionOrders\Services\pro_follow_up\MovementsXlsxServices;
use Modules\ProductionOrders\Services\pro_follow_up\ActiveOrdersXlsxServices;
use Excel;
use Modules\ProductionOrders\Exports\libraTransactionExport;
class StoreController extends Controller
{

    public function index(Request $request,Storepro_follow_upService $service)
    {
   
        $activeorders = $service->get_activeorder($request->all());
        $CustomerName  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();
        // $ColorName  = $service->getColorName();
        $ColorName  = $service->getColorsCategoryName();
        
        $UserName = $service->getUserName();

        if($request->ajax()){
            return view('productionorders::pro_follow_up/follow_up_table')->with('activeorders',$activeorders);
        }
        return view('productionorders::pro_follow_up.index')->with('activeorders',$activeorders)->with('UserName',$UserName)
        ->with('CustomerName',$CustomerName)->with('FabricName',$FabricName)->with('ColorName',$ColorName);
    //    return $request->all();
    }

 
  

       public function index2(Request $request,Storepro_follow_upService $service)
    {
        $Movements = $service->get_Movement($request->all());
        $CustomerName  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();
        // $ColorName  = $service->getColorName();
        $ColorName  = $service->getColorsCategoryName();
        $UserName = $service->getUserName();
        
        if($request->ajax()){
            return view('productionorders::pro_follow_up/follow_up_table2')->with('Movements',$Movements);
        }
        return view('productionorders::pro_follow_up.index2')->with('Movements',$Movements)->with('UserName',$UserName)
        ->with('CustomerName',$CustomerName)->with('FabricName',$FabricName)->with('ColorName',$ColorName);
// return $Movements;

    }

    public function transaction(Request $request,TransactionServices $service)
    {
        $transaction = $service->get_transaction($request->all());
        $UserName = $service->getUserName();
        
        if($request->ajax()){
            return view('productionorders::pro_follow_up/transaction_table')->with('transaction',$transaction);
        }
        return view('productionorders::pro_follow_up.index_transaction')->with('transaction',$transaction)->with('UserName',$UserName);

    }

    public function create(Storepro_follow_upService $service)
    {
        $CustomerName1  = $service->getCustomerName();
        $FabricName  = $service->getFabricName();
        $ColorsName  = $service->getColorName();
        return view('productionorders::pro_follow_up.create')
        ->with('CustomerName1',$CustomerName1)
        ->with('FabricName',$FabricName)
        ->with('ColorsName',$ColorsName);
    }
    /////////////////////////////////store///////////////////////////////
    public function store(Request $request,StoreRunningOrderService $service)
    // public function store(Request $request)
    {
    
        
        $request->validate([
            'production_order'=>['required','unique:stores'],
                'number_voucher'=>['required'],
            'customer_code'=>['required'],
            'fabrics_code'=>['required'],
            'total'=>['required'],
              'weight'=>['required'],
          'colors_code'=>['required'],
            'totalfashion'=>['required']

        ],[
            'production_order.required'=>__('Production Order is Required Field...Please Add Production Order'),
            'number_voucher.required'=>__('Number Voucher is Required Field...Please Add Number Voucher'),
            'customer_code.required'=>__('Customer Name is Required Field...Please Add Customer Name'),

            'fabrics_code.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'total.required'=>__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces'),
        //     'samplesnotes.max' =>__('Sorry...it is allowed to enter 127 characters in Samples Order Notes'),
        ]);

        $service->store_runningOrder($request->all());
     
        session()->put('success',__('Production Order Created Successfully'));

        return redirect()->back()->withInput();
        // return $request->all();
    }

///////////////////////////////////////////////////////////////////////////////
public function edit($follow_up,Edit_follow_upServices $service)
{
    $tt = $service->editFollowp($follow_up);
    // return view('productionorders::pro_follow_up.Oresid_code')->with('OresOrder',$OresOrder);
    return view('productionorders::pro_follow_up.edit')->with('tt',$tt);

    // return $OresOrder;
}
///////////////////////////////////////////////////////////////////////
public function update(Request $request,Updatepro_follow_upService $service, $Sample_order)
    {
        // $request->validate([
        //     'samplecode'=>['required'],
        //     'customer_code'=>['required'],
        //     'fabrics_code'=>['required'],
        //     'nopieces'=>['required'],
        //     'samplesnotes'=>['max:127']

        // ],[
        //     'samplecode.required'=>__('SamplesOrder ID is Required Field...Please SamplesOrder ID'),

        //     'customer_code.required'=>__('Customer Name is Required Field...Please Add Customer Name'),


        //     'fabrics_code.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
        //     'nopieces.required'=>__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces'),
        //     'samplesnotes.max' =>__('Sorry...it is allowed to enter 127 characters in Samples Order Notes'),
        // ]);

        $service->updatefollowup($Sample_order,$request->all());
        session()->put('success',__('Samples Order updated Successfully'));
       
       
        return redirect()->route('movements.index');
// return $request->all();
    }


    public function show($production_order)
    {
        $transaction = Store::find($production_order);
        // dd($Transaction);

        return view('productionorders::pro_follow_up.index_transaction')->with('transaction',$transaction);

        // return redirect()->route('transaction.show')->with('Transaction',$Transaction);
    }



    public function destroy(Store $store)
    {
        //
    }

    public function Transactionxlsx(TransactionXlsxService $service)
    {
        return $service->Transactionxlsx();
    }

    // public function movementsxlsx(MovementsXlsxServices $service)
    // {
    //     return $service->libraTransactionxlsx();
    // }



    public function edit_activeorder($activeorder,Edit_follow_upServices $service,Storepro_follow_upService $service1)
    {
        $CustomerName1  = $service1->getCustomerName();
        $FabricName  = $service1->getFabricName();
        $ColorsName  = $service1->getColorName();
        $allorderdata = $service->editFollowp($activeorder);
        return view('productionorders::pro_follow_up.edit_activeorder')->with('allorderdata',$allorderdata)
        ->with('CustomerName1',$CustomerName1)->with('FabricName',$FabricName)->with('ColorsName',$ColorsName);
    }
    public function update_activeorder(Request $request,Updatepro_follow_upService $service,$activeorder)
    // public function update_activeorder(Request $request)
    {
        $service->update_activeorder($activeorder,$request->all());
        session()->put('success',__('Samples Order updated Successfully'));
       
        return redirect()->route('pro_follow_up.index');

    }


    public function activeordersxlsx(ActiveOrdersXlsxServices $service)
    {
        return $service->Activeordersxlsx();
    }

    

    public function movementsxlsx(Request $request) 
    {
    
       $date_from=$request->date_from;
       $date_to = $request->date_to;
       $customer_type = $request->customer_type;
       $fabric=$request->fabric;
       $colors=$request->colors;
       $stage1=$request->stage1;

       return Excel::download(new libraTransactionExport($date_from,$date_to,$customer_type,$fabric,$colors,$stage1), 'movement.xlsx');
    }

}

