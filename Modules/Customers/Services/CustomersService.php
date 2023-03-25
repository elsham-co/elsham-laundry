<?php


namespace Modules\Customers\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\DB;

class CustomersService
{

    public $user;
    public $customer_info;
    private $perPage;
 
  
    public function __construct(UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->user = $user;
        $this->customer_info = $customer_info;
        $this->perPage = Session('row')??10;
    }
    public function getcustomerID()
    {
       
        $customer_info = $this->customer_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($customer_info)){
            $CustomerID = $this->customer_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $CustomerID;
        }else{
            $CustomerID = $this->customer_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $CustomerID;
        }
    }



    public function get_customers($data = null)
    {
      
        $allData = [];
        $customers = $this->customer_info;
        if(isset($data['search'])){
            $customers = $customers->where('customers.customers_code', $data['search'])->orwhere('customers_name','LIKE','%'.$data['search'].'%')
            ->orWhere('phone1','LIKE','%'.$data['search'].'%')
            ->orWhere('phone2','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }

        if(!empty($data['date_from']) && !empty($data['date_to'])){
            $dateFrom = strtotime($data['date_from']);
            $dateTo = strtotime($data['date_to']);
            $from = date('Y-m-d',$dateFrom);
            $to = date('Y-m-d',$dateTo);
            $customers = $customers->whereBetween('created_at', [$from,  $to]);
        }

        if(isset($data['customer_type'])){
                $customers = $customers->where('customers.customers_code',$data['customer_type']);
    }

    if(isset($data['user_list'])){
                $customers = $customers->where('customers.created_by',$data['user_list']);
    }

            $customers = $customers->orderBy('customers_code','desc')->paginate(20);
            // $customers = $customers->paginate($this->perPage);
        foreach ($customers as $customer){
  
        $customer->user = $this->user->where('id',$customer->created_by)->first();
        $customer->customer_info = $this->customer_info->where('customers_code',$customer->id)->first();
         
    }
    $allData['customers'] = $customers;
        return $customers;
    
    }
    


    public function get_printCustomers($data = null)
    {
      
        $allData = [];
        $customers = $this->customer_info;
    

            $customers = $customers->orderBy('customers_code','asc')->paginate(20);
        foreach ($customers as $customer){
  
        $customer->user = $this->user->where('id',$customer->created_by)->first();
        $customer->customer_info = $this->customer_info->where('customers_code',$customer->id)->first();
         
    }
    $allData['customers'] = $customers;
        return $customers;
    }

    public function getCustomerName()
    {
        $CustomersName =  $this->customer_info->get();
        foreach($CustomersName as $CustomerName)
        {
                $CustomerName->customers_name = $CustomerName->customers_name;
       
        }
        return $CustomersName;
    }
    public function getUserName()
    {
        $UserName =  $this->user->get();
        foreach($UserName as $user)
        {
                $user->username = $user->username;
       
        }
        return $UserName;
    }

}
