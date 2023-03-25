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

class EditsampleorderServices
{
    public $user;
    public $Sample_Order;
    public $customer_info;
    public $Fabric_info;
    public $Sample_creation;

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_Order,CustomerInfoRepositoryEloquent $customer_info,
    FabricInfoRepositoryEloquent $Fabric_info,SamplecreationRepositoryEloquent $Sample_creation)
{
    $this->user = $user;
    $this->Sample_Order = $Sample_Order;  
    $this->customer_info = $customer_info;
    $this->Fabric_info = $Fabric_info;
    $this->Sample_creation = $Sample_creation;
}
public function editSampleorder($editsampleorder)
{
    // $infoCustomers = $this->Sample_creation->where('samplecode',$customer)->get();
    $infoSampleorder = $this->Sample_Order->where('samplecode',$editsampleorder)->first();
    // $infoSampleorder = $this->Sample_Order->find($editsampleorder);

    $infoSampleorder->data= $this->customer_info->where('customers_code',$infoSampleorder->customer_code)->pluck('customers_name')->first();
    $infoSampleorder->fabric= $this->Fabric_info->where('fabric_code',$infoSampleorder->fabrics_code)->pluck('fabricName')->first();
    $infoSampleorder->Samplecreation= $this->Sample_creation->where('samplecode',$infoSampleorder->samplecode)->first();
    $infoSampleorder->user = $this->user->where('id',$infoSampleorder->created_by)->first();
    // $infoSampleorder->fabric= $this->Fabric_info->where('fabric_code',$infoCustomers->fabrics_code)->pluck('fabricName')->first();
    
    // $infoCustomers= $this->customer_info->where('customers_name',$infoCustomers->customer_code)->first()?$this->customer_info->where('customers_name',$infoCustomers->customer_code)->first()->customers_name:'';
    // $infoCustomers= $this->customer_info->pluck('customers_name')->first();

    $editsampleorder= $infoSampleorder;
    // return $this->Sample_creation->where('samplecode',$id)->get();
    return $editsampleorder;

}
}