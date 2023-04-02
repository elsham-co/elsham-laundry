<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class FabricsServices
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

    public function get_fabrics($data = null)
    {
        $allData = [];
        $Fabrics = $this->Fabric_info->join('fabric_category','fabric.categoryFabric','fabric_category.id')
        ->where('fabric_category.deleted_at',null)
        ->select('fabric.*');

        if(isset($data['search'])){
            $Fabrics = $Fabrics->where('fabric.fabric_code', $data['search'])
            ->orwhere('fabricName','LIKE','%'.$data['search'].'%')
            ->orwhere('fabric_category.Categoryfab_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }

        $Fabrics = $Fabrics->orderBy('fabric_code','asc')->paginate(20);
        foreach ($Fabrics as $fabric){
            $fabric->user = $this->user->where('id',$fabric->created_by)->first();
            $fabric->categoryfabrics = $this->categoryfabrics->where('id',$fabric->categoryFabric)->first();
            $fabric->Fabric_info = $this->Fabric_info->where('fabric_code',$fabric->id)->first();
             
        }
        $allData['fabric'] = $Fabrics;
        return $allData;
    }


    public function get_printfabrics()
    {
        $allData = [];
        $Fabrics = $this->Fabric_info->join('fabric_category','fabric.categoryFabric','fabric_category.id')
        ->join('users','fabric.created_by','users.id')
        ->where('fabric_category.deleted_at',null)
        ->select('fabric.*');
        // $Fabrics = $this->user;
   

        $Fabrics = $Fabrics->orderBy('fabric_code','asc')->get();
        foreach ($Fabrics as $fabric){
            $fabric->user = $this->user->where('id',$fabric->created_by)->first();
            $fabric->categoryfabrics = $this->categoryfabrics->where('id',$fabric->categoryFabric)->first();
            $fabric->Fabric_info = $this->Fabric_info->where('fabric_code',$fabric->id)->first();
             
        }
        $allData['fabric'] = $Fabrics;
        return $allData;
    }
}
