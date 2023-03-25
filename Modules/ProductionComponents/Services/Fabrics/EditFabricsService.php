<?php


namespace Modules\ProductionComponents\Services\Fabrics;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditFabricsService
{
    public $user;
    public $Fabric_info;
    public $categoryfabrics_info;

    public function __construct(FabricInfoRepositoryEloquent $Fabric_info,UserRepositoryEloquent $user,FabricsCategoryRepositoryEloquent $categoryfabrics_info)
    {
        $this->user = $user;
        $this->Fabric_info = $Fabric_info;
        $this->categoryfabrics_info = $categoryfabrics_info;
    }

    public function getFabric()
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

    public function editFabric($Fabric)
    {
        $infoFabrics = $this->Fabric_info->where('fabric_code',$Fabric->id)->get();

        $Fabric->info = $infoFabrics;
        return $Fabric;
    }

    public function getCategoryFabricID()
    {
       
        $categoryfabrics_info = $this->categoryfabrics_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($categoryfabrics_info)){
            $categoryfabricID = $this->categoryfabrics_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $categoryfabricID;
        }else{
            $categoryfabricID = $this->categoryfabrics_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $categoryfabricID;
        }
    }

}
