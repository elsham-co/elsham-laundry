<?php

namespace Modules\ProductionOrders\Entities;
use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends CoreModel
{
    use HasFactory;
    protected $fillable=['client_name'];
}
