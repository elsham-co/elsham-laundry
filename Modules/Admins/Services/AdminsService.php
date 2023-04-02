<?php


namespace Modules\Admins\Services;

use Modules\Admins\Repositories\UserRepositoryEloquent;
use Modules\Admins\Repositories\UserRoleRepositoryEloquent;

class AdminsService
{
    public $user;
    public $user_role;

    public function __construct(
        UserRepositoryEloquent $user,
        UserRoleRepositoryEloquent $user_role
    ) {
        $this->user = $user;
        $this->user_role = $user_role;
    }

    public function admins($data = null)
    {
        $admins = $this->user;
        if (isset($data['search'])) {
            $admins = $admins->where(function ($q) use ($data) {
                $q->where('username', 'LIKE', '%'.$data['search'].'%')
                        ->orWhere('email', 'LIKE', '%'.$data['search'].'%')
                        ->orWhere('phone', 'LIKE', '%'.$data['search'].'%');
            });
        }
        $admins = $admins->orderBy('id', 'desc')->paginate(10);

        foreach ($admins as $admin) {
            $userRole = $this->user_role->where('model_id', $admin->id)->pluck('role_id')->toArray();
            $role = $this->user_role->roleLang($userRole);
            $admin->role = $role;
        }

        return $admins;
    }
}