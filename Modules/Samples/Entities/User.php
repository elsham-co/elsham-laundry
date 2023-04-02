<?php


namespace Modules\Samples\Entities;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $table = 'users';
    protected $guarded = [];


}
