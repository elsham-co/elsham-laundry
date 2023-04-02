<?php


namespace Modules\Samples\Services\Sampleorder;



use Modules\Samples\Repositories\Sampleorder\SampleorderRepositoryEloquent;

class SoftDeleteSampleorderServices
{

    public $Sample_order;

                                public function __construct(SampleorderRepositoryEloquent $Sample_order)
    {
 
        $this->Sample_order = $Sample_order;
    }

    public function softDelete_Sampleorder($Sampleorder)
    {
        $infoSamples = $this->Sample_order->find($Sampleorder);
        $this->Sample_order->where('samplecode',$infoSamples->samplecode)->delete($infoSamples);
        $infoSamples->delete();
        $infoSamples->deleted_by = auth()->user()->id;
        $infoSamples->update();
    }

}