<?php


namespace Modules\Samples\Services\Sampleorder;

use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class ConfirmFromLabDateService
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
   

    public function updatefromlab_date($Sample_order,$data){
  
        $type = $this->Sample_order->where('samplecode',$Sample_order)->first();
   
            $type->update([   
                'fromlab_by'=>auth()->user()->id,  
                'fromlab_date'=>now()
               
            ]);
    
    }

}
