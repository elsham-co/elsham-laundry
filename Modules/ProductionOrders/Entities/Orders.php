<?php

namespace Modules\ProductionOrders\Entities;

use Modules\Core\Entities\CoreModel;

class Orders extends CoreModel
{
    protected $table = 'production_orders';
    protected $fillable = ['sample_code','stage_category',
    'stage_name','stage_notes','created_by','created_at','updated_by','updated_at'];
    public $timestamps = false;
}