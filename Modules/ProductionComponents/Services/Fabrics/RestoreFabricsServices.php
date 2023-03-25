<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class RestoreFabricsServices
{

    protected $Fabrics_info;

    public function __construct(FabricInfoRepositoryEloquent $Fabrics_info)
    {
        $this->Fabrics_info = $Fabrics_info;

    }

    public function restoreFabric($id)
    {
        $restorecode= $this->Fabrics_info->withTrashed()->where('id',$id)->first();

        $this->Fabrics_info->where('fabric_code',$restorecode->fabric_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}