<?php


namespace Modules\ProductionComponents\Services\Fashions;


// use Modules\Core\Entities\LanguageAttributes;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class UpdateFashionsCategoryServices
{
    
    public $fashion_category;

    public function __construct(FashionCategorRepositoryEloquent $fashion_category)
    {
      
        $this->fashion_category = $fashion_category;
    }
    public function update_Fashion_category($fascategory,$data)
    {

         $fascategory->update([     
       
        'fascategory_code'=>$data['fascategory_code'],
        'fascategory_name'=>$data['fascategory_name'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
    
        }


    }