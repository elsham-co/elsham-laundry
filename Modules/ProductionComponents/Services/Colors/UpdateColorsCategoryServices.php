<?php


namespace Modules\ProductionComponents\Services\Colors;

use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

class UpdateColorsCategoryServices
{
    
    public $color_category;

    public function __construct(ColorsCategoryRepositoryEloquent $color_category)
    {
      
        $this->color_category = $color_category;
    }
    public function update_color_category($colcategory,$data)
    {

         $colcategory->update([     
       
        'CategoryCol_code'=>$data['CategoryCol_code'],
        'CategoryCol_name'=>$data['CategoryCol_name'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
    
        }


    }