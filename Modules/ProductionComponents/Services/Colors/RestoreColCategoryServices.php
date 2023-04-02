<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;

class RestoreColCategoryServices
{

    protected $CategoryRepository;

    public function __construct(ColorsCategoryRepositoryEloquent $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;

    }

    public function restoreColCategory($id)
    {
        $restorecode= $this->CategoryRepository->withTrashed()->where('id',$id)->first();

        $this->CategoryRepository->where('CategoryCol_code',$restorecode->CategoryCol_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}