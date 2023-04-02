<?php


namespace Modules\Customers\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInfo extends CoreModel
{
    use SoftDeletes;
    protected $table = 'customers';
    protected $fillable = ['customers_code','customers_name','phone1','phone2','email','customers_notes',
    'created_by','created_at','updated_by','updated_at','deleted_by'];
    protected $dates=['deleted_at'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}