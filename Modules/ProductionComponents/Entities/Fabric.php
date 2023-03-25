<?php

namespace Modules\ProductionComponents\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class Fabric extends CoreModel
{
    use SoftDeletes;
    protected $table = 'fabric';
    protected $fillable = ['fabric_code','fabricName','fabricnotes','categoryFabric','created_by','created_at','updated_by','updated_at','deleted_by'];
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