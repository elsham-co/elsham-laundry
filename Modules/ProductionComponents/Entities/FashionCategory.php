<?php

namespace Modules\ProductionComponents\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class FashionCategory extends CoreModel
{
    use SoftDeletes;
    protected $table = 'fashioncategory';
    protected $fillable = ['fascategory_code','fascategory_name','created_by','created_at','updated_by','updated_at','deleted_by'];
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