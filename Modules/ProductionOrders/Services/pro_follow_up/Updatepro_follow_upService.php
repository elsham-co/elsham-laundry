<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\TransactionRepositoryEloquent;

use Modules\Samples\Repositories\UserRepositoryEloquent;
class Updatepro_follow_upService
{
    public $follow_info;
    public $transaction_info;
    public $customer_info;
    // public $lastId;
    public function __construct(StoreRepositoryEloquent $follow_info,TransactionRepositoryEloquent $transaction_info,
    CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->follow_info = $follow_info;
        $this->transaction_info = $transaction_info;
        $this->customer_info = $customer_info;
    }
    public function updatefollowup($followup,$data)
    {
      

        $follow_data = $this->follow_info->where('id',$followup)->first();
        $customername = $this->customer_info->where('customers_name',$data['customer_id'])
        ->pluck('customers_code')->first();

        $follow_data->update([     
       
        'customer_id'=>$customername,
        'production_order'=>$data['production_order'],
        'number_voucher'=>$data['number_voucher'],
        'total'=>$data['total'],
        'stage1'=>$data['stage1'],
        'store1'=>auth()->user()->id,
 
        
       
    ]);


    $this->transaction_info->create([
        'production_order'=>$data['production_order'],
        // 'stage_name'=>$samplecode,
        'stage1'=>$data['stage1'],
        'store1'=>auth()->user()->id,
        'transaction_note'=>$data['transaction_note'],
        'created_at'=>now(),
        'created_by'=>auth()->user()->id
    ]);


        }



        public function update_activeorder($active_order,$data)
        {
          
            // $active_order = $this->follow_info->find($active_order);
            $allactive_order = $this->follow_info->where('id',$active_order)->first();
    
            $allactive_order->update([     
           

            'production_order'=>$data['production_order'],
            'number_voucher'=>$data['number_voucher'],
            'customer_id'=>$data['customer_code'],
            'fabrics_code'=>$data['fabrics_code'],
            'total'=>$data['total'],
            'weight'=>$data['weight'],
            'colors_code'=>$data['colors_code'],
            'totalfashion'=>$data['totalfashion'],
            'modified_by'=>auth()->user()->id,
            'modified_at'=>now()

           
        ]);}
    }


