<?php

namespace Modules\Samples\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SamplesOrder extends CoreModel
{
    use SoftDeletes;
    protected $table = 'samples_order';
    protected $fillable = ['samplecode','ReceiptDate','Work_Nature','DeliveryDate','Deliveredto','fromlab_date',
    'customer_code','fabrics_code',
    'nopieces','colors_code','fashion_code',
    'sampleorder_titleimage', 'sampleorder_imagepath','samplesnotes',
    'created_by','created_at','updated_by','updated_at','deleted_by'];
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