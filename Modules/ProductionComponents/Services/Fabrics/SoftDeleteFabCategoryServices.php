<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;

class SoftDeleteFabCategoryServices
{

    public $FabricCategory_info;

                                public function __construct(FabricsCategoryRepositoryEloquent $FabricCategory_info)
    {
 
        $this->FabricCategory_info = $FabricCategory_info;
    }

    public function softDelete_Fabric($FabricCat)
    {
        $this->FabricCategory_info->where('Categoryfab_code',$FabricCat->id)->delete($FabricCat);
        $FabricCat->delete();
        $FabricCat->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $FabricCat->update();
    }

}