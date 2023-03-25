<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class Storepro_follow_upService
{
    public $user;
    public $follow_up;
    public $customer_info;
    public $Fashion_info;
    public $Fabric_info;
    public $Color_info;
    public $Color_category;

    public function __construct(UserRepositoryEloquent $user,StoreRepositoryEloquent $follow_up,
    CustomerInfoRepositoryEloquent $customer_info,ColorInfoRepositoryEloquent $Color_info,
    ColorsCategoryRepositoryEloquent $Color_category,FabricInfoRepositoryEloquent $Fabric_info)
    {
       $this->user = $user;
       $this->follow_up = $follow_up;
        $this->customer_info = $customer_info;
        $this->Fabric_info = $Fabric_info;
        $this->Color_info = $Color_info;
        $this->Color_category = $Color_category;
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

    public function getFabricName()
    {
        $FabricsName =  $this->Fabric_info->get();
        foreach($FabricsName as $FabricName)
        {
                $FabricName->fabricName = $FabricName->fabricName;
       
        }
        return $FabricsName;
    }

    public function getColorName()
    {
        $ColorsName =  $this->Color_info->get();
        foreach($ColorsName as $ColorName)
        {
                $ColorName->colorname = $ColorName->colorname;
       
        }
        return $ColorsName;
    }

    public function getColorsCategoryName()
    {
        $colCategoryName =  $this->Color_category->get();
        foreach($colCategoryName as $colCategory)
        {
                $colCategory->CategoryCol_name = $colCategory->CategoryCol_name;
       
        }
        return $colCategoryName;
    }

    public function get_activeorder($data = null)
    {
      
        $allData = [];
        $follow_up = $this->follow_up
        ->join('customers','stores.customer_id','customers.customers_code')
        ->join('fabric','stores.fabrics_code','fabric.fabric_code')
        ->join('colors_stages','stores.colors_code','colors_stages.colorcode')
        ->select('stores.*')
        ->distinct();

        if(isset($data['search'])){
            $follow_up = $follow_up->where('stores.production_order', $data['search'])
            ->orwhere('stores.number_voucher', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('customers.customers_name', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('fabric.fabricName', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('colors_stages.colorname', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('location','LIKE','%'.$data['search'].'%')
   
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
            $follow_up = $follow_up->whereBetween('stores.created_at', [$from,  $to]);
        }

        if(isset($data['customer_type'])){
            $follow_up = $follow_up->where('customers.customers_code',$data['customer_type']);
         }

         if(isset($data['fabric'])){
            $follow_up = $follow_up->where('fabric.fabric_code',$data['fabric']);
        }
        if(isset($data['colors'])){
            $follow_up = $follow_up->where('colors_stages.colcategcode',$data['colors']);
    }

    
        if(isset($data['user_list'])){
            $follow_up = $follow_up->where('stores.store1',$data['user_list']);
         }

            $follow_up = $follow_up->offset(200)->limit(100)->orderBy('id','desc')->paginate(20);
        foreach ($follow_up as $ores){
  
        $ores->user = $this->user->where('id',$ores->created_by)->pluck('username')->first();
        $ores->customer_info = $this->customer_info->where('customers_code',$ores->customer_id)->pluck('customers_name')->first();
        $ores->Fabric_info = $this->Fabric_info->where('fabric_code',$ores->fabrics_code)->pluck('fabricName')->first();
        $ores->Color_info = $this->Color_info->where('colorcode',$ores->colors_code)->pluck('colorname')->first();
    }
    $allData['stores'] = $follow_up;
        return $allData;
    }


    public function get_Movement($data = null)
    {
    
        $allData = [];
        $follow_up = $this->follow_up
        ->join('customers','stores.customer_id','customers.customers_code')
        ->join('fabric','stores.fabrics_code','fabric.fabric_code')
        ->join('colors_stages','stores.colors_code','colors_stages.colorcode')
        // ->join('transaction','stores.production_order','transaction.production_order')
        // ->where('ores_recipt.deleted_at',null)
        ->select('stores.*')
        ->distinct();
        // ->where('transaction.stage1', 'ايمو');
        /////////////////////////
        // ->where(function ($query) {
        //     $query->where('transaction.stage1', '<>', 'ايمو');
        // });              
        

////////////////////////////////


        if(isset($data['search'])){
            $follow_up = $follow_up->where('stores.production_order', $data['search'])
            ->orwhere('stores.number_voucher', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('customers.customers_name', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('fabric.fabricName', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('colors_stages.colorname', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('stage1','LIKE','%'.$data['search'].'%')
   
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
            $follow_up = $follow_up->whereBetween('stores.created_at', [$from,  $to]);
        }

        if(isset($data['customer_type'])){
            $follow_up = $follow_up->where('customers.customers_code',$data['customer_type']);
         }

         if(isset($data['fabric'])){
            $follow_up = $follow_up->where('fabric.fabric_code',$data['fabric']);
        }
        if(isset($data['colors'])){
            $follow_up = $follow_up->where('colors_stages.colorcode',$data['colors']);
        }

        if(isset($data['user_list'])){
            $follow_up = $follow_up->where('stores.stage1','روميو');
         }

            $follow_up = $follow_up->offset(200)->limit(100)->orderBy('id','desc')->paginate(20);
        foreach ($follow_up as $ores){
  
        $ores->user = $this->user->where('id',$ores->created_by)->pluck('username')->first();
        $ores->customer_info = $this->customer_info->where('customers_code',$ores->customer_id)->pluck('customers_name')->first();
        $ores->Fabric_info = $this->Fabric_info->where('fabric_code',$ores->fabrics_code)->pluck('fabricName')->first();
        $ores->Color_info = $this->Color_info->where('colorcode',$ores->colors_code)->pluck('colorname')->first();
    }
    $allData['stores'] = $follow_up;
        return $allData;
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