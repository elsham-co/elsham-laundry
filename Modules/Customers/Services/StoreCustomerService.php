<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserRepositoryEloquent;

class StoreCustomerService
{
    public $user;

    public $customer_info;

    public function __construct(UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->user = $user;
  
        $this->customer_info = $customer_info;
    }


    public function store_customer($data)
    {

        $customer = $this->customer_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
         $this->customer_info->create([

            'customers_code'=>$customer+1,
            'customers_name'=>$data['customers_name'],
            'phone1'=>$data['phone1'],
            'phone2'=>$data['phone2'],
            'email'=>$data['email'],
            'customers_notes'=>$data['customers_notes'],
            'created_by'=>auth()->user()->id,
            'created_at'=>now()
        ]);


    }

    
    public function store_customeroutmodule($data)
    {

        $customer = $this->customer_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
         $this->customer_info->create([

            'customers_code'=>$customer+1,
            'customers_name'=>$data['customers_name'],
            'phone1'=>$data['phone1'],
            'created_by'=>auth()->user()->id,
            'created_at'=>now()
        ]);


    }

}
