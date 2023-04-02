<?php


namespace Modules\Samples\Services\SamplesCreation;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fabrics\FabricInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\SamplecreationRepositoryEloquent;
use Modules\Samples\Repositories\Samplecreation\Sample_infocreationRepositoryEloquent;

    // 
class UpdatSampleServices
{
    public $Sample_creation;
    public $Sample_infocreation;
    public $Color_info;
    public $categorycolors;
    public $Fashion_info;
    public $categoryFashion;
    public $Fabric_info;
    public $customer_info;


    // public $lastId;
    public function __construct(SamplecreationRepositoryEloquent $Sample_creation,Sample_infocreationRepositoryEloquent $Sample_infocreation,
    ColorInfoRepositoryEloquent $Color_info,ColorsCategoryRepositoryEloquent $categorycolors,
    FashionInfoRepositoryEloquent $Fashion_info,FashionCategorRepositoryEloquent $categoryFashion,
    FabricInfoRepositoryEloquent $Fabric_info, CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->Sample_creation = $Sample_creation;
        $this->Sample_infocreation = $Sample_infocreation;
        $this->Color_info = $Color_info;
        $this->categorycolors = $categorycolors;
        $this->Fashion_info = $Fashion_info;
        $this->categoryFashion = $categoryFashion;
        $this->customer_info = $customer_info;
        $this->Fabric_info = $Fabric_info;
    }
    public function update_sample_creation($Sample_create,$data)
    {
       
        $customer_info = $this->customer_info->where('customers_name',$data['customer_code'])->first();
        $Fabric_info = $this->Fabric_info->where('fabricName',$data['fabrics_code'])->first();
        $Sample_creation = $this->Sample_creation->where('samplecode',$data['samplecode'])->first();

        if(empty($data['classification'])){
                $categoryFashion = 0;   
        }else{
            $categoryFashion = $data['classification'] == 'on' ? 1:0;   
           
        }
        $Sample_create->update([     
        'samplecode'=>$data['samplecode'],
        'customer_code'=>$customer_info->customers_code,
         'sample_date'=>now(),
         'fabrics_code'=>$Fabric_info->fabric_code,
        'nopieces'=>$data['nopieces'],
        // 'operation_type'=>$data['operation_type'],
        'technical_description'=>$data['technical_description'],
        'classification'=>$categoryFashion,
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
       
    ]);

    if(!empty($data['phase_name']))
    {

            foreach($data['phase_name'] as $key=>$samplecode){
        $Color_info = $this->Color_info->where('colorname',$samplecode)->first();
        if(!empty($Color_info)){
            $Category= $this->categorycolors->where('CategoryCol_code',$Color_info->colcategcode)->pluck('CategoryCol_name')->first();   
            $stagecode=$Color_info->colorname;
        }else{
            // $Color_info="فاشون";  
            $Color_info = $this->Fashion_info->where('fashionname',$samplecode)->first();
            $stagecode=$Color_info->fashionname;
            $Category= $this->categoryFashion->where('fascategory_code',$Color_info->fascateg_code)->pluck('fascategory_name')->first();   
        }

            $this->Sample_infocreation->create([
                'sample_code'=>$Sample_creation->samplecode,
                // 'stage_name'=>$samplecode,
                'stage_name'=>$stagecode,
                'stage_category'=>$Category,
                'stage_notes'=>$data['stage_notes'][$key],
                'created_at'=>now(),
                'created_by'=>auth()->user()->id
            ]);

    }
        }


}

public function update_sample_info($Sample_infocreation,$data)
{

    
    // foreach($data['phase_name'] as $key=>$samplecode){
        $Sample_info = $this->Sample_infocreation->where('sample_code',$Sample_infocreation)->first();
        $Color_info = $this->Color_info->where('colorname',$data['phase_name'])->pluck('colorname')->first();
        if(!empty($Color_info)){
            $Color_info="الوان";   
        }else{
            $Color_info="فاشون";  
        }

$Sample_info->update([     
       
    // 'sample_code'=>$Sample_creation->samplecode,
        'stage_name'=>$data['phase_name'],
        'stage_category'=>$Color_info,
        'stage_notes'=>$data['stage_notes'],
        'updated_at'=>now(),
        'updated_by'=>auth()->user()->id
   
]);

// }
// return  $Sample_info;
    }

}