<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

class SoftDeleteColorServices
{

    public $Color_info;

                                public function __construct(ColorInfoRepositoryEloquent $Color_info)
    {
 
        $this->Color_info = $Color_info;
    }

    public function softDelete_Color($Color)
    {
        $this->Color_info->where('colorcode',$Color->id)->delete($Color);
        $Color->delete();
        $Color->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $Color->update();
    }

}