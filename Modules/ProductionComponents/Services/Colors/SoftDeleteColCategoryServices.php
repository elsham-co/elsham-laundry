<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

class SoftDeleteColCategoryServices
{

    public $ColorCategory_info;

                                public function __construct(ColorsCategoryRepositoryEloquent $ColorCategory_info)
    {
 
        $this->ColorCategory_info = $ColorCategory_info;
    }

    public function softDelete_Color($ColorCat)
    {
        $this->ColorCategory_info->where('CategoryCol_code',$ColorCat->id)->delete($ColorCat);
        $ColorCat->delete();
        $ColorCat->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $ColorCat->update();
    }

}