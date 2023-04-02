<?php


namespace Modules\Samples\Services\SamplesCreation;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class confirmSampleTestService
{
    // public $user;
    public $customer_info;
    public $Fabric_info;
    public $Sample_creation;
    public $Sample_order;
    public function __construct(
    SamplecreationRepositoryEloquent $Sample_creation,SampleorderRepositoryEloquent $Sample_order,
    CustomerInfoRepositoryEloquent $customer_info,FabricInfoRepositoryEloquent $Fabric_info)
    {
        // $this->user = $user;
        $this->Sample_order = $Sample_order;
        $this->Sample_creation = $Sample_creation;
        $this->customer_info = $customer_info;
        $this->Fabric_info = $Fabric_info;
    }
   

    public function createSampleCode($data){
  
        $customer_info = $this->customer_info->where('customers_name',$data['customers_name'])->first();
        $Fabric_info = $this->Fabric_info->where('fabricName',$data['fabricName'])->first();

           $this->Sample_creation->create([
                'samplecode'=>$data['samplecode'],
                'customer_code'=>$customer_info->customers_code,
                'lab_receiptdate'=>now(),
                'fabrics_code'=>$Fabric_info->fabric_code,
                'created_at'=>now(),
                'created_by'=>auth()->user()->id
            ]);
        
    
    }

}
