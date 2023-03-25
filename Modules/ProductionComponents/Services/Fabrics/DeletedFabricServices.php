<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeletedFabricServices
{
    public $user;
    public $categoryfabrics;
    public $Fabric_info;
   
    public function __construct(UserRepositoryEloquent $user,FabricInfoRepositoryEloquent $Fabric_info,FabricsCategoryRepositoryEloquent $categoryfabrics)
    {
       $this->user = $user;
       $this->categoryfabrics =$categoryfabrics;
        $this->Fabric_info = $Fabric_info;
    }

    public function deletedfabrics($data = null)
    {
        $allData = [];
        $Fabrics = $this->Fabric_info->join('fabric_category','fabric.categoryFabric','fabric_category.id')
        ->whereNotNull('fabric.deleted_at')
        ->select('fabric.*');
     
     if(isset($data['search'])){
               $Fabrics = $Fabrics->where(function ($q) use($data){
                   $q->where('fabric_code','LIKE','%'.$data['search'].'%')
                       ->orwhere('fabricName','LIKE','%'.$data['search'].'%')
                        ->orwhere('fabric_category.Categoryfab_name','LIKE','%'.$data['search'].'%')
                          ->orWhere(function ($q) use ($data){
                $q->whereHas('user_deleted', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
               });
                });
                 });
        }


        $Fabrics = $Fabrics->onlyTrashed()->orderBy('fabric_code','asc')->paginate(20);
        foreach ($Fabrics as $fabric){
            $fabric->user = $this->user->where('id',$fabric->deleted_by)->first();
            $fabric->categoryfabrics = $this->categoryfabrics->where('id',$fabric->categoryFabric)->first();
            $fabric->Fabric_info = $this->Fabric_info->where('fabric_code',$fabric->id)->first();
             
        }
        $allData['fabric'] = $Fabrics;
        return $allData;
    }



}
