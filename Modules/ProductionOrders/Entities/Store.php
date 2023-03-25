<?php


namespace Modules\ProductionOrders\Entities;

use Modules\Core\Entities\CoreModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customers\Entities\CustomerInfo;
use Modules\ProductionComponents\Entities\Color;
use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Entities\Fabric;
use Modules\Samples\Entities\User;

class Store extends CoreModel
// class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $primaryKey = 'production_order';
    protected $fillable=['customer_id','production_order','fabrics_code','colors_code',
    'weight','number_voucher','total','note','store1','location','work_type','stage1','totalfashion','created_at'];
   
    public function order()
    {
        return $this->hasMany(Transaction::class,'production_order');
    }
    






    public function user()
    {
        return $this->belongsTo(User::class,'store1');
    }

    public function Customer()
    {
        return $this->belongsTo(CustomerInfo::class,'customer_id','customers_code');
    }

    public function Fabric()
    {
        return $this->belongsTo(Fabric::class,'fabrics_code','fabric_code');
    }

    public function Color()
    {
        return $this->belongsTo(Color::class,'colors_code','colorcode');
    }
}
