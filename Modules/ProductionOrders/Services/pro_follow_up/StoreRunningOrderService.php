<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class StoreRunningOrderService
{
    public $user;

    public $SotreRunOrder;

    public function __construct(UserRepositoryEloquent $user,StoreRepositoryEloquent $SotreRunOrder)
    {
        $this->user = $user;
  
        $this->SotreRunOrder = $SotreRunOrder;
    }


    public function store_runningOrder($data)
    {

     
         $this->SotreRunOrder->create([

            'store1'=>'1',
            'production_order'=>$data['production_order'],
            'number_voucher'=>$data['number_voucher'],
            'customer_id'=>$data['customer_code'],
            // 'work_type'=>$data['work_type'],
            'fabrics_code'=>$data['fabrics_code'],
            'total'=>$data['total'],
            'weight'=>$data['weight'],
            'colors_code'=>$data['colors_code'],
            'totalfashion'=>$data['totalfashion'],
            'note'=>$data['note'],
            'location'=>$data['location'],
            // 'created_by'=>auth()->user()->id,
            // 'created_at'=>now()
            
        ]);


    }

}
