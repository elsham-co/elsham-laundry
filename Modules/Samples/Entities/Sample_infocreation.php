<?php

namespace Modules\Samples\Entities;

use Modules\Core\Entities\CoreModel;

class Sample_infocreation extends CoreModel
{
    protected $table = 'sample_info';
    protected $fillable = ['sample_code','stage_category',
    'stage_name','stage_notes','created_by','created_at','updated_by','updated_at'];
    public $timestamps = false;
}