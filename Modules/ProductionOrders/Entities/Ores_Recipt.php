<?php

namespace Modules\ProductionOrders\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Samples\Entities\User;
use Modules\Customers\Entities\CustomerInfo;

class Ores_Recipt extends CoreModel
{
    use SoftDeletes;
    protected $table = 'ores_recipt';
    protected $fillable = ['orescode','ores_recipt_date',
    'customer_code','model_no','fabrics_code','material_number','material_weight','materials_receiver','materials_notes',
    'created_by','created_at','updated_by','updated_at','deleted_by'];
    protected $dates=['deleted_at'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    // public function customer()
    // {
    //     return $this->belongsTo(CustomerInfo::class,'customer_code');
    // }
}