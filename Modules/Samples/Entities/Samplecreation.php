<?php

namespace Modules\Samples\Entities;

use Modules\Core\Entities\CoreModel;

class Samplecreation extends CoreModel
{
    protected $table = 'sample_creation';
    protected $fillable = ['samplecode','sample_date',
    'customer_code','lab_receiptdate','fabrics_code','classification','operation_type',
    'technical_description','created_by','created_at','updated_by','updated_at'];
    protected $dates=['deleted_at'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function user_deleted()
    {
        return $this->belongsTo(User::class,'deleted_by');
    }
    
}