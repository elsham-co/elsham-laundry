<?php


namespace Modules\Samples\Services\Sampleorder;

use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class DeliveredtocustomersService
{
    // public $user;
    public $customer_info;
    public $Fabric_info;
    public $Sample_creation;
    public $Sample_order;
    public function __construct(
    SamplecreationRepositoryEloquent $Sample_creation,SampleorderRepositoryEloquent $Sample_order)
    {
        // $this->user = $user;
        $this->Sample_order = $Sample_order;
        $this->Sample_creation = $Sample_creation;
    }
   

    public function updatedeliversample($Sample_order,$data){
        $type = $this->Sample_order->where('samplecode',$data['samplecode'])->first();
            $type->update([     
                'Delivery_by'=>auth()->user()->id, 
                'Deliveredto'=>$data['Deliveredto'],
                'DeliveryDate'=>now()
               
            ]);
    
    }

}
