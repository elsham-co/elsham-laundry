<?php

namespace Modules\Admins\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admins\Services\AdminStatusService;


class AdminUpdateStatusController extends Controller
{
    public function updateStatus(User $user,Request $request,AdminStatusService $service)
    {
        $service->updateStatus($user,$request->all());
        session()->put('success',__('Admin Status updated Successfully'));
        return redirect()->back();
    }
}
