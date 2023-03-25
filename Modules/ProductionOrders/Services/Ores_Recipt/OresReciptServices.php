<?php


namespace Modules\ProductionOrders\Services\Ores_Recipt;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\Ores_Recipt\OresReciptRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class OresReciptServices
{
    public $user;
    public $OresRecipt;
    public $customer_info;
    public $Fashion_info;
    public $Fabric_info;

    public function __construct(UserRepositoryEloquent $user,OresReciptRepositoryEloquent $OresRecipt,
    CustomerInfoRepositoryEloquent $customer_info,
    FabricInfoRepositoryEloquent $Fabric_info)
    {
       $this->user = $user;
       $this->OresRecipt = $OresRecipt;
        $this->customer_info = $customer_info;
        $this->Fabric_info = $Fabric_info;
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


    public function getOresID()
    {

        $OresRecipt = $this->OresRecipt->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($OresRecipt)){
            $OresOrderID = $this->OresRecipt->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $OresOrderID;
        }else{
            $OresOrderID = $this->OresRecipt->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $OresOrderID;
        }
    }

    
    public function getMaterialReceiver()
    {
        $OresReceiver =  $this->OresRecipt->select('materials_receiver')->distinct()->get();
        foreach($OresReceiver as $ReceiverName)
        {
                $ReceiverName->materials_receiver = $ReceiverName->materials_receiver;
       
        }
        return $OresReceiver;
    }


    public function get_Oresorder($data = null)
    {
      
        $allData = [];
        $OresRecipt = $this->OresRecipt
        ->join('customers','ores_recipt.customer_code','customers.customers_code')
        ->join('fabric','ores_recipt.fabrics_code','fabric.fabric_code')
        ->where('ores_recipt.deleted_at',null)
        ->select('ores_recipt.*');
        if(isset($data['search'])){
            $OresRecipt = $OresRecipt->where('orescode', $data['search'])
            ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
            ->orWhere('fabric.fabricName','LIKE','%'.$data['search'].'%')
            ->orWhere('model_no','LIKE','%'.$data['search'].'%')
            ->orWhere('materials_receiver','LIKE','%'.$data['search'].'%')
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
            $OresRecipt = $OresRecipt->whereBetween('ores_recipt_date', [$from,  $to]);
        }

        if(isset($data['customer_type'])){
                $OresRecipt = $OresRecipt->where('customers.customers_code',$data['customer_type']);
    }

    if(isset($data['fabric'])){
        $OresRecipt = $OresRecipt->where('fabric.fabric_code',$data['fabric']);
}

if(isset($data['Receiver'])){
    $OresRecipt = $OresRecipt->where('ores_recipt.materials_receiver',$data['Receiver']);
}

    if(isset($data['user_list'])){
                $OresRecipt = $OresRecipt->where('ores_recipt.created_by',$data['user_list']);
    }

            $OresRecipt = $OresRecipt->orderBy('orescode','desc')->paginate(20);
            // $customers = $customers->paginate($this->perPage);
        foreach ($OresRecipt as $ores){
  
        $ores->user = $this->user->where('id',$ores->created_by)->pluck('username')->first();
        $ores->customer_info = $this->customer_info->where('customers_code',$ores->customer_code)->pluck('customers_name')->first();
        $ores->Fabric_info = $this->Fabric_info->where('fabric_code',$ores->fabrics_code)->pluck('fabricName')->first();
    }
    $allData['ores_recipt'] = $OresRecipt;
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