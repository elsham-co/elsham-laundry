<?php


namespace Modules\ProductionComponents\Services\Fashions;



use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;

class RestoreFashionServices
{

    protected $Fashions_info;

    public function __construct(FashionInfoRepositoryEloquent $Fashions_info)
    {
        $this->Fashions_info = $Fashions_info;
        // $this->productEditSQS =$productEditSQS;

    }

    public function restoreFashion($id)
    {
        // $this->Fashions_info->where('id',$id)->restore();
        // // $id->deleted_by = null;
        // $sqsData = [];
        // $log = [
        //     'restored'=>['','Fashion Restored Successfully']
        // ];
        $restorecode= $this->Fashions_info->withTrashed()->where('id',$id)->first();

        $this->Fashions_info->where('fashioncode',$restorecode->fashioncode)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();


    }
}