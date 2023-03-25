<?php


namespace Modules\Samples\Services\Sampleorder;

use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class SamplesOrderServices
{
    public $user;
    public $Sample_creation;
    public $Sample_order;
    public $customer_info;
    public $Fashion_info;
    public $Fashion_category;
    public $Fabric_info;
    public $categoryfabrics;
    public $Color_info;
    public $categorycolors;

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_order,
    SamplecreationRepositoryEloquent $Sample_creation,CustomerInfoRepositoryEloquent $customer_info,
    FashionInfoRepositoryEloquent $Fashion_info,FabricInfoRepositoryEloquent $Fabric_info,
    ColorInfoRepositoryEloquent $Color_info,FabricsCategoryRepositoryEloquent $categoryfabrics,
    ColorsCategoryRepositoryEloquent $categorycolors,FashionCategorRepositoryEloquent $Fashion_category)
    {
       $this->user = $user;
       $this->Sample_creation = $Sample_creation;
        $this->Sample_order = $Sample_order;
        $this->customer_info = $customer_info;
        $this->Fashion_info = $Fashion_info;
        $this->Fabric_info = $Fabric_info;
        $this->categoryfabrics = $categoryfabrics;
        $this->Color_info = $Color_info;
        $this->categorycolors = $categorycolors;
        $this->Fashion_category = $Fashion_category;
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

    // ================================================
    public function getFabricsCategoryName()
    {
        $fabCategoryName =  $this->categoryfabrics->get();
        foreach($fabCategoryName as $fabCategory1)
        {
                $fabCategory1->Categoryfab_name = $fabCategory1->Categoryfab_name;
       
        }
        return $fabCategoryName;
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
    public function getColorsCategoryName()
    {
        $colCategoryName =  $this->categorycolors->get();
        foreach($colCategoryName as $colCategory)
        {
                $colCategory->CategoryCol_name = $colCategory->CategoryCol_name;
       
        }
        return $colCategoryName;
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

    public function getColorNames()
    {
        $ColorsName =  $this->Color_info->pluck('colorname');
        foreach($ColorsName as $ColorName)
        {
                $ColorName = $ColorName;
       
        }
        return $ColorsName;
    }


    public function getColorID()
    {
       
        $Color = $this->Color_info->withTrashed()->select('id')
        ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
        
        return $Color;
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

    public function getFashionNames()
    {
        $FashionsName =  $this->Fashion_info->pluck('fashionname');
        foreach($FashionsName as $FashionName)
        {
                $FashionName = $FashionName;
       
        }
        return $FashionsName;
    }
     // /  //============================================
     public function getFashionCatName()
     {
         $Fashion_category =  $this->Fashion_category->get();
         foreach($Fashion_category as $FasCatName)
         {
                 $FasCatName->fascategory_name = $FasCatName->fascategory_name;
        
         }
         return $Fashion_category;
     }
    //    =======================================================================================
    public function getSampleOrderID()
    {

        $Sample_order = $this->Sample_order->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($Sample_order)){
            $SampleOrderID = $this->Sample_order->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $SampleOrderID;
        }else{
            $SampleOrderID = $this->Sample_order->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $SampleOrderID;
        }
    }

    public function get_sampleorder($data = null)
    {
        $allData = [];

        $Samplesorder = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
        ->leftJoin('sample_creation','samples_order.samplecode','sample_creation.samplecode')
        ->where('samples_order.deleted_at',null)
        ->select('samples_order.*');
        
        if(isset($data['search'])){
            $Samplesorder = $Samplesorder->where('samples_order.samplecode', $data['search'])
            ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
            ->orWhere('fabric.fabricName','LIKE','%'.$data['search'].'%')
            ->orwhere('colors_code', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
            ->orwhere('Deliveredto','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }

        if(!empty($data['date_type'])){
            if($data['date_type'] == 'ReceiptDate'){
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $Samplesorder = $Samplesorder->whereBetween('ReceiptDate', [$from,  $to]);
                }
            }elseif($data['date_type'] == 'lab_receiptdate'){
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $Samplesorder = $Samplesorder->whereBetween('lab_receiptdate', [$from,  $to]);
                }
            }elseif($data['date_type'] == 'fromlab_date'){
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $Samplesorder = $Samplesorder->whereBetween('fromlab_date', [$from,  $to]);
                }
            }elseif($data['date_type'] == 'DeliveryDate'){
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $Samplesorder = $Samplesorder->whereBetween('DeliveryDate', [$from,  $to]);
                }
            }
        }

     

        if(isset($data['customer_type'])){
            $Samplesorder = $Samplesorder->where('customers.customers_code',$data['customer_type']);
}

if(isset($data['fabric'])){
    $Samplesorder = $Samplesorder->where('fabric.fabric_code',$data['fabric']);
}

// if(isset($data['Receiver'])){
// $OresRecipt = $OresRecipt->where('ores_recipt.materials_receiver',$data['Receiver']);
// }

if(isset($data['user_list'])){
            $Samplesorder = $Samplesorder->where('samples_order.created_by',$data['user_list']);
}


        $Samplesorder = $Samplesorder->orderBy('id','desc')->paginate(20);
        foreach ($Samplesorder as $Singale_order){
            $Singale_order->user = $this->user->where('id',$Singale_order->created_by)->pluck('username')->first();
            $Singale_order->customer_info = $this->customer_info->where('customers_code',$Singale_order->customer_code)->pluck('customers_name')->first();
            $Singale_order->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_order->fabrics_code)->pluck('fabricName')->first();
            $Singale_order->Sample_creation = $this->Sample_creation->where('samplecode',$Singale_order->samplecode)->first();
            // $Singale_order->Sample_order = $this->Sample_order->where('samplecode',$Singale_order->id)->first();
             
            
        }
        $allData['samples_order'] = $Samplesorder;
        return $allData;
    }

    public function count_unDelivered($data = null)
    {
      
        $countunDelivered = $this->Sample_order->where('samples_order.deleted_at',null)
        ->where('samples_order.DeliveryDate',null)->count();
        return $countunDelivered;
    }

    public function getUserName()
    {
        $UserName =  $this->user->where('active','1')->get();
        foreach($UserName as $user)
        {
                $user->username = $user->username;
       
        }
        return $UserName;
    }
}