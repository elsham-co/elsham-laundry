<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserRepositoryEloquent;

class DeletedCustomersServices
{

    public $user;
    public $customer_info;

    public function __construct(UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->user = $user;
        $this->customer_info = $customer_info;
    }

    public function deletedCustomers($data = null)
    {
      
        $allData = [];
        $customers = $this->customer_info->join('users','customers.created_by','users.id')
        ->select('customers.*');
        if(isset($data['search'])){
               $customers  = $customers ->where(function ($q) use($data){
                   $q->where('customers_code','LIKE','%'.$data['search'].'%')
                       ->orwhere('customers_name','LIKE','%'.$data['search'].'%')
                    //    ->orWhere('email','LIKE','%'.$data['search'].'%')
                        ->orWhere('phone1','LIKE','%'.$data['search'].'%')
                       ->orWhere('phone2','LIKE','%'.$data['search'].'%')->orwhere('users.username','LIKE','%'.$data['search'].'%');
               });
        }

            $customers = $customers->onlyTrashed()->orderBy('customers_code','asc')->paginate(20);
        foreach ($customers as $customer){
  
        $customer->user = $this->user->where('id',$customer->deleted_by)->first();
        $customer->customer_info = $this->customer_info->where('customers_code',$customer->id)->first();
         
    }
    $allData['customers'] = $customers;
        return $customers;
    }



}
