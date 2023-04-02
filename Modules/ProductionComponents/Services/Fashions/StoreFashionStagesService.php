<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Entities\Fashion;
use Modules\ProductionComponents\Entities\FashionCategory;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

class StoreFashionStagesService
{
    public $fashion_info;
    public $fashion_category;
    
    public function __construct(FashionInfoRepositoryEloquent $fashion_info,FashionCategorRepositoryEloquent $fashion_category)
    {
        $this->fashion_info = $fashion_info;
        $this->fashion_category = $fashion_category;
    }
    public function store_fashionStages($data)
    {
        $fashion_info = $this->fashion_info->withTrashed()->select('id')->latest('id')->pluck('id')->first();
         $this->fashion_info->create([     
       
        'fashioncode'=>$fashion_info+1,
        'fashionname'=>$data['fashionname'],
        'fascateg_code'=>$data['fascateg_code'],
        'fashioncount'=>$data['fashioncount'],
        'fashionnotes'=>$data['fashionnotes'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);
        }


    }