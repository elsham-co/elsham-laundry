<?php


namespace Modules\Samples\Services\SamplesCreation;

use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\Sample_infocreationRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\UserRepositoryEloquent;


class TestSamplesServices
{
    public $user;
    public $Sample_creation;
    public $Sample_info;
    public $Sample_order;
    public $customer_info;
    public $Fashion_info;
    public $Fabric_info;
    public $categoryfabrics;
    public $Color_info;
    public $categorycolors;
    public $categoryFashion;
  

    public function __construct(UserRepositoryEloquent $user,SampleorderRepositoryEloquent $Sample_order,
    SamplecreationRepositoryEloquent $Sample_creation,Sample_infocreationRepositoryEloquent $Sample_info,
    CustomerInfoRepositoryEloquent $customer_info,
    FashionInfoRepositoryEloquent $Fashion_info,FabricInfoRepositoryEloquent $Fabric_info,
    ColorInfoRepositoryEloquent $Color_info,FabricsCategoryRepositoryEloquent $categoryfabrics,
    ColorsCategoryRepositoryEloquent $categorycolors,FashionCategorRepositoryEloquent $categoryFashion)
    {
       $this->user = $user;
       $this->Sample_creation = $Sample_creation;
       $this->Sample_info =$Sample_info;
       $this->Sample_order = $Sample_order;
        $this->customer_info = $customer_info;
        $this->Fashion_info = $Fashion_info;
        $this->Fabric_info = $Fabric_info;
        $this->categoryfabrics = $categoryfabrics;
        $this->Color_info = $Color_info;
        $this->categorycolors = $categorycolors;
        $this->categoryFashion = $categoryFashion;
    }


    

    public function get_testsamples($data = null)
    {
        $allData = [];

        $testsample = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        ->leftJoin('sample_creation','samples_order.samplecode','sample_creation.samplecode')
        ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
        // ->join('users','samples_order.created_by','users.id')
        ->where('samples_order.deleted_at',null)
        ->where('sample_creation.lab_receiptdate',null)
        ->select('samples_order.*');

        if(isset($data['search'])){
               $testsample = $testsample->where(function ($q) use($data){
                   $q->where('samples_order.samplecode','LIKE','%'.$data['search'].'%')
                    //    ->orwhere('users.username','LIKE','%'.$data['search'].'%')
                       ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
                       ->orwhere('colors_code','LIKE','%'.$data['search'].'%')
                       ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
                        ->orwhere('fabric.fabricName','LIKE','%'.$data['search'].'%');
               });
        }

        $testsample = $testsample->orderBy('samplecode','desc')->paginate(25);
        foreach ($testsample as $Singale_test){
            $Singale_test->user = $this->user->where('id',$Singale_test->created_by)->first();
            $Singale_test->customer_info = $this->customer_info->where('customers_code',$Singale_test->customer_code)->first();
            $Singale_test->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_test->fabrics_code)->first();
            $Singale_test->Sample_creation = $this->Sample_creation->where('samplecode',$Singale_test->samplecode)->first();
            // $Singale_test->Sample_order = $this->Sample_order->where('samplecode',$Singale_test->samplecode)->first();
            
        }
        $allData['samples_order'] = $testsample;
        return $allData;
    }

    public function count_testsamples($data = null)
    {
      
        $counttestsample = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
        // ->join('users','samples_order.created_by','users.id')
        ->leftJoin('sample_creation','samples_order.samplecode','sample_creation.samplecode')
        ->where('samples_order.deleted_at',null)
        ->where('sample_creation.lab_receiptdate',null)
        ->select('samples_order.*')->count();
        return $counttestsample;
    }

    public function get_SampleStelinLab($data = null)
    {
        $allData = [];
        $testsample = $this->Sample_order->join('customers','samples_order.customer_code','customers.customers_code')
        ->join('fabric','samples_order.fabrics_code','fabric.fabric_code')
        // ->join('users','samples_order.created_by','users.id')
        ->leftJoin('sample_creation','samples_order.samplecode','sample_creation.samplecode')
        ->where('samples_order.deleted_at',null)
        ->where('sample_creation.sample_date',null)
        ->whereNotNull('sample_creation.lab_receiptdate')
        ->select('samples_order.*');
        if(isset($data['search'])){
               $testsample = $testsample->where(function ($q) use($data){
                   $q->where('samples_order.samplecode','LIKE','%'.$data['search'].'%')
                    //    ->orwhere('users.username','LIKE','%'.$data['search'].'%')
                       ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
                       ->orwhere('colors_code','LIKE','%'.$data['search'].'%')
                       ->orwhere('fashion_code','LIKE','%'.$data['search'].'%')
                        ->orwhere('fabric.fabricName','LIKE','%'.$data['search'].'%');
               });
        }

        $testsample = $testsample->orderBy('samplecode','desc')->paginate(20);
        foreach ($testsample as $Singale_test){
            $Singale_test->user = $this->user->where('id',$Singale_test->created_by)->first();
            $Singale_test->customer_info = $this->customer_info->where('customers_code',$Singale_test->customer_code)->first();
            $Singale_test->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_test->fabrics_code)->first();
            $Singale_test->Sample_creation = $this->Sample_creation->where('samplecode',$Singale_test->samplecode)->first();
            $Singale_test->Sample_order = $this->Sample_order->where('samplecode',$Singale_test->samplecode)->first();
            
        }
        $allData['samples_order'] = $testsample;
        return $allData;
    }

    public function count_SampleStelinLab($data = null)
    {
    
        $countsampleinlab = $this->Sample_creation->join('customers','sample_creation.customer_code','customers.customers_code')
        ->join('fabric','sample_creation.fabrics_code','fabric.fabric_code')
        // ->join('users','samples_order.created_by','users.id')
        ->join('samples_order','sample_creation.samplecode','samples_order.samplecode')
        ->where('samples_order.deleted_at',null)
        ->where('sample_creation.sample_date',null)
        ->whereNotNull('sample_creation.lab_receiptdate')
        ->select('sample_creation.*')->count();
        return $countsampleinlab;
    }

    public function get_Samplebank($data = null)
    {
        $allData = [];
        $banksample = $this->Sample_creation->join('customers','sample_creation.customer_code','customers.customers_code')
        ->join('fabric','sample_creation.fabrics_code','fabric.fabric_code')
        ->join('samples_order','sample_creation.samplecode','samples_order.samplecode')
        ->join('sample_info','sample_creation.samplecode','sample_info.sample_code')
        // ->join('colorscategory','sample_info.stage_name','colorscategory.CategoryCol_name')
        ->where('sample_creation.deleted_at',null)
        ->where('samples_order.deleted_at',null)
        ->whereNotNull('sample_creation.sample_date')
        ->groupBy('sample_info.sample_code')
        ->select('sample_creation.*');

        if(isset($data['search'])){
            $banksample = $banksample->where('sample_creation.samplecode', $data['search'])
            ->orwhere('customers.customers_name','LIKE','%'.$data['search'].'%')
            ->orWhere('fabric.fabricName','LIKE','%'.$data['search'].'%')
            ->orWhere('sample_info.stage_name','LIKE','%'.$data['search'].'%')
            ->orWhere('technical_description','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }

        if(!empty($data['date_type'])){
            if($data['date_type'] == 'sample_date'){
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $banksample = $banksample->whereBetween('sample_date', [$from,  $to]);
                }
            }else{
                if(!empty($data['date_from']) && !empty($data['date_to'])){
                    $dateFrom = strtotime($data['date_from']);
                    $dateTo = strtotime($data['date_to']);
                    $from = date('Y-m-d',$dateFrom);
                    $to = date('Y-m-d',$dateTo);
                    $banksample = $banksample->whereBetween('fromlab_date', [$from,  $to]);
                }
            }
        }

     

        if(isset($data['customer_type'])){
            $banksample = $banksample->where('customers.customers_code',$data['customer_type']);
}

if(isset($data['fabric'])){
    $banksample = $banksample->where('fabric.fabric_code',$data['fabric']);
}

if(isset($data['operation_type'])){
// $banksample = $banksample->where('sample_creation.operation_type',$data['operation_type']);
$Category= $this->categorycolors->where('CategoryCol_name',$data['operation_type'])->first();  
if(!empty($Category)){ 
$banksample = $banksample->where('sample_info.stage_category',$Category->CategoryCol_name);
}else{
    // $Category=$data['operation_type'];
    $Category= $this->categoryFashion->where('fascategory_name',$data['operation_type'])->first(); 
    $banksample = $banksample->where('sample_info.stage_category',$Category->fascategory_name);
}

}

if(isset($data['user_list'])){
            $banksample = $banksample->where('sample_creation.created_by',$data['user_list']);
}


        $banksample = $banksample->orderBy('samplecode','desc')->paginate(20);
        foreach ($banksample as $Singale_test){
            $Singale_test->user = $this->user->where('id',$Singale_test->created_by)->pluck('username')->first();
            $Singale_test->customer_info = $this->customer_info->where('customers_code',$Singale_test->customer_code)->pluck('customers_name')->first();
            $Singale_test->Fabric_info = $this->Fabric_info->where('fabric_code',$Singale_test->fabrics_code)->pluck('fabricName')->first();
            $Singale_test->Sample_info = $this->Sample_info->where('sample_code',$Singale_test->samplecode)->pluck('stage_name');
            $Singale_test->Sample_order = $this->Sample_order->where('samplecode',$Singale_test->samplecode)->pluck('fromlab_date')->first();
            
        }
        $allData['sample_creation'] = $banksample;
        return $allData;
    }
}