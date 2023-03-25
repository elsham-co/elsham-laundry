<?php


namespace Modules\ProductionOrders\Services\orders;

use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
// use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
// use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\ProductionOrders\Repositories\orders\OrdersRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class OrdersServices
{
    public $user;
    public $Orders;
    public $customer_info;
    public $Fashion_info;
    public $Fabric_info;
    public $Color_info;
    public $thread_info;

    public function __construct(UserRepositoryEloquent $user,OrdersRepositoryEloquent $Orders,
    CustomerInfoRepositoryEloquent $customer_info, ThreadInfoRepositoryEloquent $thread_info,
    FashionInfoRepositoryEloquent $Fashion_info,FabricInfoRepositoryEloquent $Fabric_info,
    ColorInfoRepositoryEloquent $Color_info)
    {
       $this->user = $user;
        $this->Orders = $Orders;
        $this->customer_info = $customer_info;
        $this->Fashion_info = $Fashion_info;
        $this->Fabric_info = $Fabric_info;
        $this->thread_info = $thread_info;
        $this->Color_info = $Color_info;
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

    public function getCustomerID()
    {
       
        $customer_info = $this->customer_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($customer_info)){
            $Customer = $this->customer_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $Customer;
        }else{
            $Customer = $this->customer_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $Customer;
        }
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

    public function getFabricID()
    {
       
        $Fabric_info = $this->Fabric_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($Fabric_info)){
            $Fabric = $this->Fabric_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $Fabric;
        }else{
            $Fabric = $this->Fabric_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $Fabric;
        }
    }
    
    // /  //============================================

    public function getColorName()
    {
        $ColorsName =  $this->Color_info->get();
        foreach($ColorsName as $ColorName)
        {
                $ColorName->colorname = $ColorName->colorname;
       
        }
        return $ColorsName;
    }
      // /  //============================================
    public function getFashionName()
    {
        $FashionsName =  $this->Fashion_info->get();
        foreach($FashionsName as $FashionName)
        {
                $FashionName->fashionname = $FashionName->fashionname;
       
        }
        return $FashionsName;
    }
        // ==============================================================================================
public function getThreadName()
{
    $thread_info =  $this->thread_info->get();
    foreach($thread_info as $ThreadName)
    {
            $ThreadName->thread_name = $ThreadName->thread_name;
   
    }
    return $thread_info;
}
    //    =======================================================================================

    public function get_orders($data = null)
    {
        // $allData = [];

        // $Samplesorder = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        // ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
        // // ->join('users','samples_order.created_by','users.id')
     
        // ->where('samples_order.deleted_at',null)
        // ->select('samples_order.*');
        
        // if(isset($data['search'])){
        //        $Samplesorder = $Samplesorder->where(function ($q) use($data){
        //            $q->where('samplecode','LIKE','%'.$data['search'].'%')
        //                ->orWhereDate('ReceiptDate','LIKE','%'.$data['search'].'%')
        //                ->orwhere('Deliveredto','LIKE','%'.$data['search'].'%')
        //             //    ->orwhere('users.username','LIKE','%'.$data['search'].'%')
        //                ->orwhere('colors_code', 'LIKE', '%'.$data['search'].'%')
        //                ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
        //                ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
        //                 ->orwhere('fabric.fabricName','LIKE','%'.$data['search'].'%');
        //        });
        // }

        // $Samplesorder = $Samplesorder->orderBy('samplecode','desc')->paginate(20);
        // foreach ($Samplesorder as $Singale_order){
        //     $Singale_order->user = $this->user->where('id',$Singale_order->created_by)->pluck('username')->first();
        //     $Singale_order->customer_info = $this->customer_info->where('customers_code',$Singale_order->customer_code)->pluck('customers_name')->first();
        //     $Singale_order->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_order->fabrics_code)->pluck('fabricName')->first();
        //     $Singale_order->Sample_creation = $this->Sample_creation->where('samplecode',$Singale_order->samplecode)->first();

             
            
        // }
        // $allData['samples_order'] = $Samplesorder;
        // return $allData;
    }
}