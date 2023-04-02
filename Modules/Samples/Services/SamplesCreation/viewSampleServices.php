<?php

namespace Modules\Samples\Services\SamplesCreation;

use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\Sample_infocreationRepositoryEloquent;
use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserRepositoryEloquent;

class viewSampleServices
{
    public $Sample_creation;
    public $Sample_info;
    public $customer_info;
    public $Fabric_info;
    public $Sample_order;
    public $Fashion_info;
    public $Color_info;
    public $user;

    public function __construct(UserRepositoryEloquent $user,SamplecreationRepositoryEloquent $Sample_creation, Sample_infocreationRepositoryEloquent $Sample_info,
    CustomerInfoRepositoryEloquent $customer_info,FashionInfoRepositoryEloquent $Fashion_info, ColorInfoRepositoryEloquent $Color_info,
    FabricInfoRepositoryEloquent $Fabric_info,SampleorderRepositoryEloquent $Sample_order)
{
    $this->Sample_creation = $Sample_creation; 
    $this->Sample_info = $Sample_info;
    $this->customer_info = $customer_info;
    $this->Fabric_info = $Fabric_info;
    $this->Sample_order = $Sample_order;
    $this->Fashion_info = $Fashion_info;
    $this->Color_info = $Color_info;
    $this->user = $user;
}

public function viewSampleBank($samplebank)
{

    $infoSamples = $this->Sample_creation->find($samplebank);

    $infoSamples->data= $this->customer_info->where('customers_code',$infoSamples->customer_code)->pluck('customers_name')->first();
    $infoSamples->fabric= $this->Fabric_info->where('fabric_code',$infoSamples->fabrics_code)->pluck('fabricName')->first();

    $infoSamples->Sample_info= $this->Sample_info->where('sample_code',$infoSamples->samplecode)->get();
    $infoSamples->classification= $this->Sample_creation->where('samplecode',$infoSamples->samplecode)->pluck('classification');
    if($infoSamples->classification=1){
$classification =__('Sample');
    }else{
$classification =__('Cartel'); 
    }
    $infoSamples->classification=$classification;
    $infoSamples->Sampleorder= $this->Sample_order->where('samplecode',$infoSamples->samplecode)->first();
    $infoSamples->user_sampleorder_created = $this->user->where('id',$infoSamples->Sampleorder->created_by)->pluck('username')->first();
    $infoSamples->user_sampleorder_updated = $this->user->where('id',$infoSamples->Sampleorder->updated_by)->pluck('username')->first();
    $infoSamples->user_sampleorder_delivered = $this->user->where('id',$infoSamples->Sampleorder->Delivery_by)->pluck('username')->first();
    $infoSamples->user_sampleorder_fromlab = $this->user->where('id',$infoSamples->Sampleorder->fromlab_by)->pluck('username')->first();
    $infoSamples->user_sample_created = $this->user->where('id',$infoSamples->created_by)->pluck('username')->first();
    $infoSamples->user_sample_updated = $this->user->where('id',$infoSamples->updated_by)->pluck('username')->first();
    
    $samplebank= $infoSamples;
    return $samplebank;

}

}    