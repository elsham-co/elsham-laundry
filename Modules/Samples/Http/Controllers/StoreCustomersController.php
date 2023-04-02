<?php

namespace Modules\Samples\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerInfo;
use Modules\Samples\Services\Sampleorder\SamplesOrderServices;
use Modules\Customers\Services\StoreCustomerService;
use Modules\ProductionComponents\Services\Fabrics\StoreFabricsService;

class StoreCustomersController extends Controller
{

    public function store(Request $request,StoreCustomerService $service)
    // public function store_customeroutmodule(Request $request,$customers_code,$customers_name,$phone1,SamplesOrderServices $service)
    {

        $request->validate([
            'customers_code'=>['required' ,'unique:customers'],
            'customers_name'=>['required' ,'unique:customers','max:45'],
            'phone1'=>['required' ,'numeric','digits_between:1,11']
          

        ],[
            'customers_code.required'=>__('Customer ID is Required Field...Please Add Customer ID'),
            'customers_code.unique'=>__('Customer ID is Unique Field, Please Add Customer ID'),

            'customers_name.required'=>__('Customer Name is Required Field...Please Add Customer Name'),
            'customers_name.unique'=>__('Customer Name is Unique Field, Please Add Customer Name'),
            'customers_name.max'=>__('Sorry...it is allowed to enter 45 characters in Customer Name'),

            'phone1.required'=>__('Phone Number 1 is Required Field...Please Add Phone Number 1'),
            'phone1.numeric'=>__('Phone Number 1 is Numeric Field Only'),
            'phone1.digits_between'=>__('Sorry...it is allowed to enter 11 characters in Phone Number 1'),

        ]);

        $customers = $service->store_customeroutmodule($request->all());
        session()->put('success',__('Customer Created Successfully'));
        return redirect()->back()->withInput();


        // $save =new CustomerInfo;
        // $save->customers_code = $customers_code;
        // $save->customers_name= $customers_name;
        // $save->phone1=$phone1;
        // $save->created_by = auth()->user()->id;
        // $save->created_at = now();
        // $save->save();
        // $CustomerID =$service->getCustomerID();
        // return  'success'->with('CustomerID',$CustomerID);
        // return response()->json();
   
    }
    public function storeFabric(Request $request,StoreFabricsService $service)
     {
        $request->validate([
          
            'fabric_code' => ['required','numeric','unique:fabric'],
            'fabricName' => ['required' ,'unique:fabric','max:45'],
            'categoryFabric' => ['required']
            ],[
            'fabric_code.required'=>__('Fabric Code is Required Field...Please Add Fabric Code'),
              'fabric_code.numeric'=>__('Fabric Code is Numeric Field Only'),
            'fabric_code.unique'=>__('Fabric Code is Unique Field, Please Add Fabric Code'),
            'fabricName.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'fabricName.unique'=>__('Fabric Name is Unique Field, Please Add Fabric Name'),
            'fabricName.max'=>__('Sorry...it is allowed to enter 45 characters in Fabric Name'),

            'categoryFabric.required'=>__('Sorry...You Mast Select A Category Fabric Name'),

        ]);

        
        $service->store_fabricmodal($request->all());
        session()->put('success',__('Fabric Created Successfully'));
        return redirect()->back()->withInput();
    }

}
