<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

class RestoreFasCategoryServices
{

    protected $CategoryRepository;

    public function __construct(FashionCategorRepositoryEloquent $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;

    }

    public function restoreFasCategory($id)
    {
        // $this->CategoryRepository->where('id',$id)->restore();
        // $this->deleted_by = null;
    
        // $sqsData = [];
        // $log = [
        //     'restored'=>['','Fashion Category has been restored']
        // ];

        $restorecode= $this->CategoryRepository->withTrashed()->where('id',$id)->first();

        $this->CategoryRepository->where('fascategory_code',$restorecode->fascategory_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}