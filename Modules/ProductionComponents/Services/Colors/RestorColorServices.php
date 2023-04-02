<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
class RestorColorServices
{

    protected $Colors_info;

    public function __construct(ColorInfoRepositoryEloquent $Colors_info)
    {
        $this->Colors_info = $Colors_info;
        // $this->productEditSQS =$productEditSQS;

    }

    public function restoreColor($id)
    {
        // $this->Colors_info->where('id',$id)->restore();
        // $sqsData = [];
        // $log = [
        //     'restored'=>['','Color Restored Successfully']
        // ];

        $restorecode= $this->Colors_info->withTrashed()->where('id',$id)->first();

        $this->Colors_info->where('colorcode',$restorecode->colorcode)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}