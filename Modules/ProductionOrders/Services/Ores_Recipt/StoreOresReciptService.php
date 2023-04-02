<?php


namespace Modules\ProductionOrders\Services\Ores_Recipt;


use Modules\ProductionOrders\Repositories\Ores_Recipt\OresReciptRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class StoreOresReciptService
{
    public $user;
    public $OresRecipt;

    public function __construct(UserRepositoryEloquent $user,OresReciptRepositoryEloquent $OresRecipt)
    {
        $this->user = $user;
        $this->OresRecipt = $OresRecipt;
    }


    public function store_ores_order($data)
    {

$OresRecipt = $this->OresRecipt->withTrashed()->select('id')->latest('id')->pluck('id')->first();
        $this->OresRecipt->create([
           
            'orescode'=>$OresRecipt+1,
            'ores_recipt_date'=>now(),
            'customer_code'=>$data['customer_code'],
            'model_no'=>$data['model_no'],
            'fabrics_code'=>$data['fabrics_code'],

            'material_number'=>$data['material_number'],
           
            'materials_receiver'=>$data['materials_receiver'],
            'materials_notes'=>$data['materials_notes'],
            'created_at'=>now(),
            'created_by'=>auth()->user()->id
        ]);


    }

}
