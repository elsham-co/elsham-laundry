<?php


namespace Modules\Samples\Services\Sampleorder;



use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class StoreSamplesOrderService
{
    public $user;
    public $Sample_order;
    public $Sample_orderinfo;

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_order, SamplecreationRepositoryEloquent $Sample_orderinfo)
    {
        $this->user = $user;
        $this->Sample_order = $Sample_order;
        $this->Sample_orderinfo = $Sample_orderinfo;
    }


    public function store_sample_order($data)
    {
        if(empty($data['colors_code'])){
            $colors = "";   
    }else{
        $colors = json_encode($data['colors_code']??[],JSON_UNESCAPED_UNICODE);   
       
    }
    if(empty($data['fashion_code'])){
        $fashion = "";   
}else{
    $fashion = json_encode($data['fashion_code']??[],JSON_UNESCAPED_UNICODE);   
   
}
$Sample_order = $this->Sample_order->withTrashed()->select('id')->latest('id')->pluck('id')->first();
        $this->Sample_order->create([
           
            'samplecode'=>$Sample_order+1,
            'ReceiptDate'=>now(),
            'customer_code'=>$data['customer_code'],
            'fabrics_code'=>$data['fabrics_code'],
            // 'colors_code'=>json_encode($data['colors_code']??[],JSON_UNESCAPED_UNICODE),
            'colors_code'=>$colors,
            // 'fashion_code'=>json_encode($data['fashion_code']??[],JSON_UNESCAPED_UNICODE),
            
            'fashion_code'=>$fashion,
           
            'nopieces'=>$data['nopieces'],
            'samplesnotes'=>$data['samplesnotes'],
            'created_at'=>now(),
            'created_by'=>auth()->user()->id
        ]);


    }

}
