<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Services\Fabrics\FabricsXlsxService;

class FabricsExpertReportController extends Controller
{
    public function Fabricsxlsx(FabricsXlsxService $service)
    {
        return $service->Fabricsxlsx();
    }


   
}
