<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Entities\Fashion;
use Modules\ProductionComponents\Entities\FashionCategory;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

    // 
class UpdateFoshionsServices
{
    public $Fashion_info;
    public $Fashion_category;

    public function __construct(FashionInfoRepositoryEloquent $Fashion_info,FashionCategorRepositoryEloquent $Fashion_category)
    {
        $this->Fashion_info = $Fashion_info;
        $this->Fashion_category = $Fashion_category;
    }
    public function update_fashion($Fashions,$data)
    {


        $Fashions->update([     
       
            'fashioncode'=>$data['fashioncode'],
            'fashionname'=>$data['fashionname'],
            'fascateg_code'=>$data['fascateg_code'],
            'fashioncount'=>$data['fashioncount'],
            'fashionnotes'=>$data['fashionnotes'],
            'created_by'=>auth()->user()->id,
            'created_at'=>now()
       
    ]);
        }


    }