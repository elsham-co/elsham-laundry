<?php

namespace Modules\ProductionOrders\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Samples\Entities\User;
use Modules\Customers\Entities\CustomerInfo;

class Transaction extends CoreModel
{
    use SoftDeletes;
    protected $table = 'transaction';
    protected $fillable = ['production_order','transaction','store1','transaction_note',
    'created_by','created_at','updated_by','updated_at','deleted_by','stage1'];
    protected $dates=['deleted_at'];
    public $timestamps = false;


    public function Transaction_order()
    {
        return $this->belongsTo(Store::class,'production_order','production_order');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
