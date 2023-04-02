<?php


namespace Modules\ProductionComponents\Services\Colors;

use Modules\ProductionComponents\Entities\Color;
use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

class StoreColorStagesService
{
    public $color_info;
    public $color_category;
    // public $lastId;
    public function __construct(ColorInfoRepositoryEloquent $color_info,ColorsCategoryRepositoryEloquent $color_category)
    {
        $this->color_info = $color_info;
        $this->color_category = $color_category;
    }
    public function store_colorStages($data)
    {
        $color_info = $this->color_info->withTrashed()->select('id')->latest('id')->pluck('id')->first();
         $this->color_info->create([     
       
        'colorcode'=>$color_info+1,
        'colorname'=>$data['colorname'],
        'colcategcode'=>$data['colcategcode'],
        'colornotes'=>$data['colornotes'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
        }


    }