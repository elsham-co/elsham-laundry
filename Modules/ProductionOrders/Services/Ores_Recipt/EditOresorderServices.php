<?php


namespace Modules\ProductionOrders\Services\Ores_Recipt;

use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;



use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\Ores_Recipt\OresReciptRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class EditOresorderServices
{
    public $user;
    public $OresRecipt;
    public $customer_info;
    public $Fabric_info;
  

    public function __construct(UserRepositoryEloquent $user,OresReciptRepositoryEloquent $OresRecipt,CustomerInfoRepositoryEloquent $customer_info,
    FabricInfoRepositoryEloquent $Fabric_info)
{
    $this->user = $user;
    $this->OresRecipt = $OresRecipt;  
    $this->customer_info = $customer_info;
    $this->Fabric_info = $Fabric_info;

}
public function editOresorder($editOresorder)
{

    $infoOresorder = $this->OresRecipt->where('orescode',$editOresorder)->first();

    $infoOresorder->data= $this->customer_info->where('customers_code',$infoOresorder->customer_code)->pluck('customers_name')->first();
    $infoOresorder->fabric= $this->Fabric_info->where('fabric_code',$infoOresorder->fabrics_code)->pluck('fabricName')->first();
    $infoOresorder->user = $this->user->where('id',$infoOresorder->created_by)->first();
    

    $editsampleorder= $infoOresorder;
    return $editsampleorder;

}
}