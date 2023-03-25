<?php


namespace Modules\Samples\Services\Sampleorder;



use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;

class UpdateSamplesOrderService
{
    public $user;
    public $Sample_order;
    // public $Sample_orderinfo;

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_order)
    {
        $this->user = $user;
        $this->Sample_order = $Sample_order;
        // $this->Sample_orderinfo = $Sample_orderinfo;
    }
    public function update_sample_order($Sample_order2,$data)
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
        $Sample_order2->update([     
       
            'samplecode'=>$data['samplecode'],
                'nopieces'=>$data['nopieces'],
                'colors_code'=> $colors,
                'fashion_code'=>$fashion,
            'samplesnotes'=>$data['samplesnotes'],
            'updated_by'=>auth()->user()->id,
            'updated_at'=>now()
           
        ]);
    }
}