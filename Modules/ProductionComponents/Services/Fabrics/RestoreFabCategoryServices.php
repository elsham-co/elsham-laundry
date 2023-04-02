<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;

class RestoreFabCategoryServices
{

    protected $CategoryRepository;

    public function __construct(FabricsCategoryRepositoryEloquent $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
   

    }

    public function restoreFabCategory($id)
    {
        $restorecode= $this->CategoryRepository->withTrashed()->where('id',$id)->first();

        $this->CategoryRepository->where('Categoryfab_code',$restorecode->Categoryfab_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}