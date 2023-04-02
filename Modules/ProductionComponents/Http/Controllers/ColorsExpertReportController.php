<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Services\Colors\ColorsXlsxService;

class ColorsExpertReportController extends Controller
{
    public function Colorsxlsx(ColorsXlsxService $service)
    {
        return $service->Colorsxlsx();
    }


   
}
