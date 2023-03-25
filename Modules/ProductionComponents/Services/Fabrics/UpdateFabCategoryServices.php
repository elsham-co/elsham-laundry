<?php


namespace Modules\ProductionComponents\Services\Fabrics;

use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;

class UpdateFabCategoryServices
{
    
    public $fabric_category;
    // public $lastId;
    public function __construct(FabricsCategoryRepositoryEloquent $fabric_category)
    {
      
        $this->fabric_category = $fabric_category;
    }
    public function update_fabric_category($fabcategory,$data)
    {

         $fabcategory->update([     
       
        'Categoryfab_code'=>$data['Categoryfab_code'],
        'Categoryfab_name'=>$data['Categoryfab_name'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
    
        }


    }