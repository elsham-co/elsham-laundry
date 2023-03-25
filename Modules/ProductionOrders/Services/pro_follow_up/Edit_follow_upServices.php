<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;

use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;



use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class Edit_follow_upServices
{
    public $user;
    public $Followup;
    public $customer_info;
    public $Fabric_info;
  

    public function __construct(UserRepositoryEloquent $user,StoreRepositoryEloquent $Followup,CustomerInfoRepositoryEloquent $customer_info,
    FabricInfoRepositoryEloquent $Fabric_info)
{
    $this->user = $user;
    $this->Followup = $Followup;  
    $this->customer_info = $customer_info;
    $this->Fabric_info = $Fabric_info;

}
public function editFollowp($editOresorder)
{

    $infoOresorder = $this->Followup->where('production_order',$editOresorder)->first();

    $infoOresorder->data= $this->customer_info->where('customers_code',$infoOresorder->customer_id)->pluck('customers_name')->first();
    $infoOresorder->fabric= $this->Fabric_info->where('fabric_code',$infoOresorder->fabrics_code)->pluck('fabricName')->first();
    $infoOresorder->user = $this->user->where('id',$infoOresorder->created_by)->first();
    

    $editsampleorder= $infoOresorder;
    return $editsampleorder;

}
}