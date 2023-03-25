<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;


class UpdateCustomerService1
{

    public $customer_info;

    public function __construct(CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->customer_info = $customer_info;
  
    }
    public function updateCustomer($customer,$data)
    {


        $customer->update([     
       
        'customers_code'=>$data['customers_code'],
        'customers_name'=>$data['customers_name'],
        'phone1'=>$data['phone1'],
        'phone2'=>$data['phone2'],
        'email'=>$data['email'],
        'customers_notes'=>$data['customers_notes'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
        }


    }