<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;

class SoftDeleteFabricServices
{

    public $Fabric_info;

                                public function __construct(FabricInfoRepositoryEloquent $Fabric_info)
    {
 
        $this->Fabric_info = $Fabric_info;
    }

    public function softDelete_Fabric($Fabric)
    {
        $this->Fabric_info->where('fabric_code',$Fabric->fabric_code)->delete($Fabric);
        $Fabric->delete();
        $Fabric->deleted_by = auth()->user()->id;
        $Fabric->update();
    }

}