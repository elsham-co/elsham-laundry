<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerInfo;
use Modules\Customers\Services\CustomersService;
use Modules\Customers\Services\DeleteCustomerService;
use Modules\Customers\Services\EditCustomerService;
use Modules\Customers\Services\StoreCustomerService;
use Modules\Customers\Services\UpdateCustomerService1;
use Modules\Customers\Services\DeletedCustomersServices;
use Modules\Customers\Services\RestorCustomerServices;

class CustomersController extends Controller
{

 
    public function index(Request $request,CustomersService $service)
    
    {
        $CustomerName = $service->getCustomerName();
        $UsersName = $service->getUserName();
        $customers = $service->get_customers($request->all());
        if($request->ajax()){
            return view('customers::Customers/customer_table')->with('customers',$customers);
        }
        return view('customers::Customers.index')->with('customers',$customers)
        ->with('CustomerName',$CustomerName)->with('UsersName',$UsersName);
        // return $CustomerName;
        // return $request->all();
    }

// public function index()
    
// {
 
//     return view('customers::index');

// }

    public function create(CustomersService $service)
    {
        $Customers = $service->getcustomerID();
        return view('customers::Customers.create')->with('Customers',$Customers);

    }


    public function store(Request $request,StoreCustomerService $service)
    {

        $request->validate([
            'customers_code'=>['required' ,'unique:customers'],
            'customers_name'=>['required' ,'unique:customers','max:45'],
            'phone1'=>['required' ,'numeric','digits_between:1,11'],
            'phone2'=>['nullable' ,'numeric','digits_between:1,11'],
            'email'=>'nullable|unique:customers',
            'customers_notes' => ['max:127']

        ],[
            'customers_code'=>__('Customer ID is Required Field...Please Add Customer ID'),
            'customers_code.unique'=>__('Customer ID is Unique Field, Please Add Customer ID'),
            
            'customers_name.required'=>__('Customer Name is Required Field...Please Add Customer Name'),
            'customers_name.unique'=>__('Customer Name is Unique Field, Please Add Customer Name'),
            'customers_name.max'=>__('Sorry...it is allowed to enter 45 characters in Customer Name'),

            'phone1.required'=>__('Phone Number 1 is Required Field...Please Add Phone Number 1'),
            'phone1.numeric'=>__('Phone Number 1 is Numeric Field Only'),
            'phone1.digits_between'=>__('Sorry...it is allowed to enter 11 characters in Phone Number 1'),

            'phone2.numeric'=>__('Phone Number 2 is Numeric Field Only'),
            'phone2.digits_between'=>__('Sorry...it is allowed to enter 11 characters in Phone Number 2'),
     
            'email.required'=>__('email is required'),
            'email.unique'=>__('email is already been taken'), 
            'customers_notes.max' =>__('Sorry...it is allowed to enter 127 characters in Customer Notes'),

        ]);

        $service->store_customer($request->all());
        session()->put('success',__('Customer Created Successfully'));
        return redirect()->back()->withInput();
    }



    public function edit(CustomerInfo $customer,EditCustomerService $service)
    {
        $customer = $service->editCustomer($customer);
        return view('customers::Customers.edit')
            ->with('customer',$customer);
    }


    public function update(Request $request, CustomerInfo $customer,UpdateCustomerService1 $service,CustomersService $service1)
    {
        $request->validate([
            'customers_code'=>['required'],
            'customers_name'=>['required' ,'max:45'],
            'phone1'=>['required' ,'numeric','digits_between:1,11'],
            'phone2'=>['nullable' ,'numeric','digits_between:1,11'],
            // 'email'=>'nullable|unique:customers',
            'customers_notes' => ['max:127']

        ],[
            'customers_code'=>__('Customer ID is Required Field...Please Add Customer ID'),

            'customers_name.required'=>__('Customer Name is Required Field...Please Add Customer Name'),
            'customers_name.max'=>__('Sorry...it is allowed to enter 45 characters in Customer Name'),

            'phone1.required'=>__('Phone Number 1 is Required Field...Please Add Phone Number 1'),
            'phone1.numeric'=>__('Phone Number 1 is Numeric Field Only'),
            'phone1.digits_between'=>__('Sorry...it is allowed to enter 11 characters in Phone Number 1'),

            'phone2.numeric'=>__('Phone Number 2 is Numeric Field Only'),
            'phone2.digits_between'=>__('Sorry...it is allowed to enter 11 characters in Phone Number 2'),
     
            // 'email.required'=>__('email is required'),
            // 'email.unique'=>__('email is already been taken'), 
            'customers_notes.max' =>__('Sorry...it is allowed to enter 127 characters in Customer Notes'),

        ]);


        // $service->update_color($customer,$request->all());
        // session()->put('success',__('Customer updated Successfully'));
        // return redirect()->back();
        // return $customer;

       $service->updateCustomer($customer,$request->all());
        session()->put('success',__('Customer updated Successfully'));
        $customers = $service1->get_customers($request->all());
        if($request->ajax()){
            return view('customers::Customers/customer_table')->with('customers',$customers);
        }
        return view('customers::Customers.index')->with('customers',$customers);
    }


    public function destroy(CustomerInfo $customer,DeleteCustomerService $service)
    {
        $service->delete_customer($customer);
        session()->put('success',__('Customer deleted Successfully'));
        return redirect()->back();
        // return $customer;
    }
    public function restoreCustomers($id,RestorCustomerServices $service)
    {

       $service->restoreCustomers($id);

        session()->put('success',__('Customer Restored Successfully'));
        return redirect()->back();
    }
        /**
    * Display All deleted resource.
    */
   public function deletedCustomers(Request $request,DeletedCustomersServices $service)
   {
       $customers = $service->deletedCustomers($request->all());
       if($request->ajax()){
           return view('customers::Customers/deleted_Customers_table')->with('customers',$customers);
       }
       return view('customers::Customers.deleted_Customers')->with('customers',$customers);

   }
      /*pass print route*/
      public function printCustomers(Request $request,CustomersService $service)
      {
          $customers = $service->get_printCustomers($request->all());
   
              return view('customers::Customers.print_Customers')->with('customers',$customers);
      }
}
