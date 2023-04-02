<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Services\ThreadsTrashedXlsxService;
use Modules\ProductionComponents\Services\ThreadsXlsxService;

class ThreadsEpertReportController extends Controller
{
    public function Threadsxlsx(ThreadsXlsxService $service)
    {
        return $service->threadsxlsx();
    }
    public function ThreadsTrashedxlsx(ThreadsTrashedXlsxService $service)
    {
        return $service->threadsTrashedxlsx();
    }

   
}
