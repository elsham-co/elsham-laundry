<?php

namespace Modules\Permissions\Entities;

use Modules\Core\Entities\CoreModel;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends CoreModel
{
    use HasRoles,HasPermissions;
    protected $guard_name = 'web';
    protected $table = 'users';
}