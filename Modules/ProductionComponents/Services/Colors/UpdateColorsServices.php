<?php


namespace Modules\ProductionComponents\Services\Colors;

use Modules\ProductionComponents\Entities\Color;
use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

    // 
class UpdateColorsServices
{
    public $Color_info;
    public $color_category;

    public function __construct(ColorInfoRepositoryEloquent $Color_info,ColorsCategoryRepositoryEloquent $color_category)
    {
        $this->Color_info = $Color_info;
        $this->color_category = $color_category;
    }
    public function update_color($Colors,$data)
    {


        $Colors->update([     
       
        'colorcode'=>$data['colorcode'],
        'colorname'=>$data['colorname'],
        'colcategcode'=>$data['colcategcode'],
        'colornotes'=>$data['colornotes'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);
        }


    }