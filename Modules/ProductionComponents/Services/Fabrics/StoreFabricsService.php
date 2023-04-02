<?php


namespace Modules\ProductionComponents\Services\Fabrics;

use Modules\ProductionComponents\Entities\Fabric;
use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;

class StoreFabricsService
{
    public $fabric_info;
    public $fabric_category;
    // public $lastId;
    public function __construct(FabricInfoRepositoryEloquent $fabric_info,FabricsCategoryRepositoryEloquent $fabric_category)
    {
        $this->fabric_info = $fabric_info;
        $this->fabric_category = $fabric_category;
    }
    public function store_fabric($data)
    {
        $fabric_info = $this->fabric_info->withTrashed()->select('id')->latest('id')->pluck('id')->first();
         $this->fabric_info->create([     
       
        'fabric_code'=>$fabric_info+1,
        'fabricName'=>$data['fabricName'],
        'categoryFabric'=>$data['categoryFabric'],
        'fabricnotes'=>$data['fabricnotes'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
        }

        public function store_fabricmodal($data)
        {
            $fabric_info = $this->fabric_info->withTrashed()->select('id')->latest('id')->pluck('id')->first();
            $this->fabric_info->create([     
           
            'fabric_code'=>$fabric_info+1,
            'fabricName'=>$data['fabricName'],
            'categoryFabric'=>$data['categoryFabric'],
            'created_by'=>auth()->user()->id,
            'created_at'=>now()
           
        ]);
            }

    }