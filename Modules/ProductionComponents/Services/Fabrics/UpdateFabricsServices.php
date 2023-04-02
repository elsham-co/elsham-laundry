<?php


namespace Modules\ProductionComponents\Services\Fabrics;

use Modules\ProductionComponents\Entities\Fabric;
use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
    // 
class UpdateFabricsServices
{
    public $fabric_info;
    public $fabric_category;
    // public $lastId;
    public function __construct(FabricInfoRepositoryEloquent $fabric_info,FabricsCategoryRepositoryEloquent $fabric_category)
    {
        $this->fabric_info = $fabric_info;
        $this->fabric_category = $fabric_category;
    }
    public function update_fabric($Fabrics,$data)
    {

        // $info = $this->fabric_category->where('Categoryfab_name', $Categoryfab_name)->first()->id;
        // $this->categoryfabrics->where('id',$fabric->categoryFabric)->first();

        $Fabrics->update([     
       
        'fabric_code'=>$data['fabric_code'],
        'fabricName'=>$data['fabricName'],

        'categoryFabric'=>$data['categoryFabric'],
        'fabricnotes'=>$data['fabricnotes'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
        }


    }