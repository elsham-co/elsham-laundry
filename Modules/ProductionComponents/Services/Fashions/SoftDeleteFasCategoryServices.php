<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

class SoftDeleteFasCategoryServices
{

    public $FasCategory_info;

                                public function __construct(FashionCategorRepositoryEloquent $FasCategory_info)
    {
 
        $this->FasCategory_info = $FasCategory_info;
    }

    public function softDelete_Fashion($FashionCat)
    {
        $this->FasCategory_info->where('fascategory_code',$FashionCat->id)->delete($FashionCat);
        $FashionCat->delete();
        $FashionCat->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $FashionCat->update();
    }

}