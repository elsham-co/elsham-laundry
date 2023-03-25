<?php


namespace Modules\Admins\Services;


class AdminStatusService
{
    public function updateStatus($admin,$data)
    {
        $admin->update([
            'active'=>$data['active'] == 'on' ? 1:0
        ]);
    }
}
