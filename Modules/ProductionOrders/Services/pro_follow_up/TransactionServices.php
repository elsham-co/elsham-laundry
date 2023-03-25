<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\ProductionOrders\Repositories\pro_follow_up\TransactionRepositoryEloquent;

use Modules\Samples\Repositories\UserRepositoryEloquent;

class TransactionServices
{
    public $user;
    public $follow_up;
    public $Transaction_info;
    public $customer_info;
    // public $Fashion_info;
    public $Fabric_info;
    public $Color_info;


    public function __construct(UserRepositoryEloquent $user,
    TransactionRepositoryEloquent $Transaction_info)
    {
       $this->user = $user;
       $this->Transaction_info = $Transaction_info;

        
    }
    public function get_transaction($data = null)
    {
        $allData = [];

        $all_Transaction = $this->Transaction_info
        ->select('transaction.*');
        
        if(isset($data['search'])){
            $all_Transaction = $all_Transaction->where('production_order', $data['search'])
            ->orwhere('stage1', 'LIKE', '%'.$data['search'].'%')
            ->orwhere('transaction_note','LIKE','%'.$data['search'].'%')
   
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }

      
            if(!empty($data['date_from']) && !empty($data['date_to'])){
                $dateFrom = strtotime($data['date_from']);
                $dateTo = strtotime($data['date_to']);
                $from = date('Y-m-d',$dateFrom);
                $to = date('Y-m-d',$dateTo);
                $all_Transaction = $all_Transaction->whereBetween('created_at', [$from,  $to]);
            }
 
            if(isset($data['user_list'])){
                $all_Transaction = $all_Transaction->where('created_by',$data['user_list']);
    }


        $all_Transaction = $all_Transaction->orderBy('id','desc')->paginate(20);
        foreach ($all_Transaction as $Singale_order){
            $Singale_order->user = $this->user->where('id',$Singale_order->created_by)->pluck('username')->first();
            
        }
        $allData['transaction'] = $all_Transaction;
        return $allData;
    }

    public function getUserName()
    {
        $UserName =  $this->user->get();
        foreach($UserName as $user)
        {
                $user->username = $user->username;
       
        }
        return $UserName;
    }

}
