<?php


namespace Modules\Samples\Services\Sampleorder;

use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class DeletedSampleOrderservice
{
    public $user;
    public $Sample_creation;
    public $Sample_order;
    public $customer_info;
    public $Fashion_info;
    public $Fabric_info;
    public $categoryfabrics;
    public $Color_info;
    public $categorycolors;

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_order,
    SamplecreationRepositoryEloquent $Sample_creation,CustomerInfoRepositoryEloquent $customer_info,
    FashionInfoRepositoryEloquent $Fashion_info,FabricInfoRepositoryEloquent $Fabric_info,
    ColorInfoRepositoryEloquent $Color_info,FabricsCategoryRepositoryEloquent $categoryfabrics,
    ColorsCategoryRepositoryEloquent $categorycolors)
    {
       $this->user = $user;
       $this->Sample_creation = $Sample_creation;
        $this->Sample_order = $Sample_order;
        $this->customer_info = $customer_info;
        $this->Fashion_info = $Fashion_info;
        $this->Fabric_info = $Fabric_info;
        $this->categoryfabrics = $categoryfabrics;
        $this->Color_info = $Color_info;
        $this->categorycolors = $categorycolors;
    }

    public function get_deletedsampleorder($data = null)
    {
        $allData = [];

        $Samplesorder = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
     
        ->whereNotNull('samples_order.deleted_at')
        ->select('samples_order.*');
        
        // if(isset($data['search'])){
    
        //        $Samplesorder = $Samplesorder->where(function ($q) use($data){
        //            $q->where('samplecode','LIKE','%'.$data['search'].'%')
        //                ->orWhereDate('ReceiptDate','LIKE','%'.$data['search'].'%')
        //                ->orwhere('Deliveredto','LIKE','%'.$data['search'].'%')
        //                ->orwhere('colors_code', 'LIKE', '%'.$data['search'].'%')
        //                ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
        //                ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
        //                 ->orwhere('fabric.fabricName','LIKE','%'.$data['search'].'%');
        //        });
        // }

        if(isset($data['search'])){
            $Samplesorder = $Samplesorder->where(function ($q) use($data){
                $q->where('samplecode','LIKE','%'.$data['search'].'%')
                ->orwhere('colors_code', 'LIKE', '%'.$data['search'].'%')
                ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
                ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
                ->orwhere('fabric.fabricName','LIKE','%'.$data['search'].'%')

                       ->orWhere(function ($q) use ($data){
             $q->whereHas('user_deleted', function ($query) use ($data) {
                 $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
            });
             });
              });
     }

        $Samplesorder = $Samplesorder->onlyTrashed()->orderBy('samplecode','desc')->paginate(20);
        foreach ($Samplesorder as $Singale_order){
            $Singale_order->user = $this->user->where('id',$Singale_order->deleted_by)->pluck('username')->first();
            $Singale_order->customer_info = $this->customer_info->where('customers_code',$Singale_order->customer_code)->pluck('customers_name')->first();
            $Singale_order->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_order->fabrics_code)->pluck('fabricName')->first();
            $Singale_order->Sample_creation = $this->Sample_creation->where('samplecode',$Singale_order->samplecode)->first();
             
            
        }
        $allData['samples_order'] = $Samplesorder;
        return $allData;
    }
}