<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

class StoreFashionCategoryService
{
    
    public $fashion_category;
    // public $lastId;
    public function __construct(FashionCategorRepositoryEloquent $fashion_category)
    {
      
        $this->fashion_category = $fashion_category;
    }
    public function store_Fashion_category($data)
    {
        $fashion_category = $this->fashion_category->withTrashed()->select('id')->latest('id')->pluck('id')->first();
         $this->fashion_category->create([     
       
        'fascategory_code'=>$fashion_category+1,
        'fascategory_name'=>$data['fascategory_name'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
    
        }


    }
