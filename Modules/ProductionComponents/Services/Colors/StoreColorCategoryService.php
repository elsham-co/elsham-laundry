<?php


namespace Modules\ProductionComponents\Services\Colors;

use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

class StoreColorCategoryService
{
    
    public $fabric_category;
    // public $lastId;
    public function __construct(ColorsCategoryRepositoryEloquent $fabric_category)
    {
      
        $this->fabric_category = $fabric_category;
    }
    public function store_Color_category($data)
    {
        $fabric_category = $this->fabric_category->withTrashed()->select('id')->latest('id')->pluck('id')->first();
         $this->fabric_category->create([     
       
        'CategoryCol_code'=>$fabric_category+1,
        'CategoryCol_name'=>$data['CategoryCol_name'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
    
        }


    }