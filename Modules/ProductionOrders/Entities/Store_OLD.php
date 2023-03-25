<?php


namespace Modules\ProductionOrders\Entities;

use Modules\Core\Entities\CoreModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Samples\Entities\User;

class Store extends CoreModel
// class Store extends Model
{
    use HasFactory;
    protected $fillable=['customer_id','production_order','fabrics_code','colors_code',
    'weight','number_voucher','total','note','store1','location','work_type','stage1','totalfashion','created_at'];
    
    
    public function user()
    {
        return $this->belongsTo(User::class,'store1');
    }
}
