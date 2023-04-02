<?php


namespace Modules\ProductionComponents\Services\Fabrics;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class ShowFabricsService
{
    public $user;
    public $Fabric_info;
    public $categoryfabrics_info;

    public function __construct(FabricInfoRepositoryEloquent $Fabric_info,UserRepositoryEloquent $user,FabricsCategoryRepositoryEloquent $categoryfabrics_info)
    {
        // $this->user = $user;
        $this->Fabric_info = $Fabric_info;
        $this->categoryfabrics_info = $categoryfabrics_info;
    }

   
    public function ShowFabric($Fabric)
    {
        $infoFabrics = $this->Fabric_info->where('fabric_code',$Fabric->id)->first();
        $infoFabrics= $this->categoryfabrics_info->pluck('Categoryfab_name')->first();
        $Fabric->info = $infoFabrics;
        return $Fabric;
    }

}
