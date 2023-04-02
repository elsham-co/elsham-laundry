<?php


namespace Modules\ProductionComponents\Services\Fabrics;

use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;

class StoreCategoryService
{
    
    public $fabric_category;
    // public $lastId;
    public function __construct(FabricsCategoryRepositoryEloquent $fabric_category)
    {
      
        $this->fabric_category = $fabric_category;
    }
    public function store_fabric_category($data)
    {
        $lastId = $this->fabric_category->withTrashed()->select('id')->latest('id')->pluck('id')->first();
        
        $this->fabric_category->create([     
       
        'Categoryfab_code'=>$lastId+1,
        'Categoryfab_name'=>$data['Categoryfab_name'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
    
        }


    }