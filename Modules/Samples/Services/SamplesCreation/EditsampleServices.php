<?php

namespace Modules\Samples\Services\SamplesCreation;

use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\Sample_infocreationRepositoryEloquent;
use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;

class EditsampleServices
{
    public $Sample_creation;
    public $Sample_info;
    public $customer_info;
    public $Fabric_info;
    public $Sample_order;
    public function __construct(SamplecreationRepositoryEloquent $Sample_creation, Sample_infocreationRepositoryEloquent $Sample_info,
    CustomerInfoRepositoryEloquent $customer_info,
    FabricInfoRepositoryEloquent $Fabric_info,SampleorderRepositoryEloquent $Sample_order)
{
    $this->Sample_creation = $Sample_creation; 
    $this->Sample_info = $Sample_info;
    $this->customer_info = $customer_info;
    $this->Fabric_info = $Fabric_info;
    $this->Sample_order = $Sample_order;
}
public function editCustomer($customer)
{
    $infoCustomers =$customer;

    $infoCustomers = $this->Sample_order->where('id',$customer)->pluck('samplecode')->first();
    $infoCustomers = $this->Sample_creation->where('samplecode',$infoCustomers)->first();

   
    $infoCustomers->data= $this->customer_info->where('customers_code',$infoCustomers->customer_code)->pluck('customers_name')->first();

    $infoCustomers->fabric= $this->Fabric_info->where('fabric_code',$infoCustomers->fabrics_code)->pluck('fabricName')->first();
    $infoCustomers->Sampleorder= $this->Sample_order->where('samplecode',$infoCustomers->samplecode)->first();
    $infoCustomers->Colors= $this->Sample_order->where('samplecode',$infoCustomers->samplecode)->pluck('colors_code');
    $infoCustomers->Fashions= $this->Sample_order->where('samplecode',$infoCustomers->samplecode)->pluck('fashion_code');


    $customer= $infoCustomers;
    return $customer;
}

public function editSampleBank($samplebank)
{

    $infoSamples = $this->Sample_creation->find($samplebank);

    $infoSamples->data= $this->customer_info->where('customers_code',$infoSamples->customer_code)->pluck('customers_name')->first();
    $infoSamples->fabric= $this->Fabric_info->where('fabric_code',$infoSamples->fabrics_code)->pluck('fabricName')->first();
    $infoSamples->Sample_info= $this->Sample_info->where('sample_code',$infoSamples->samplecode)->get();
    // $infoSamples->Sample_info2= $this->Sample_info->where('sample_code',$infoSamples->samplecode)->pluck('stage_notes');
    $infoSamples->classification= $this->Sample_creation->where('samplecode',$infoSamples->samplecode)->pluck('classification');
    if($infoSamples->classification=1){
$classification =__('Sample');
    }else{
$classification =__('Cartel'); 
    }
    $infoSamples->classification=$classification;
        $infoSamples->technical_description2= $this->Sample_creation->where('samplecode',$infoSamples->samplecode)->pluck('technical_description');
    $infoSamples->Sampleorder= $this->Sample_order->where('samplecode',$infoSamples->samplecode)->pluck('nopieces')->first();

    $samplebank= $infoSamples;
    return $samplebank;

}

}    