<?php


namespace Modules\ProductionComponents\Services\Fashions;



use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;

class SoftDeleteFashionServices
{

    public $Fashion_info;

                                public function __construct(FashionInfoRepositoryEloquent $Fashion_info)
    {
 
        $this->Fashion_info = $Fashion_info;
    }

    public function softDelete_Fashion($Fashion)
    {
        $this->Fashion_info->where('fashioncode',$Fashion->id)->delete($Fashion);
        $Fashion->delete();
        $Fashion->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $Fashion->update();
    }

}