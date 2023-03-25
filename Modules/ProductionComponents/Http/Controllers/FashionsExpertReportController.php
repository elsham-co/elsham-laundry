<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Services\Fashions\FashionsXlsxService;

class FashionsExpertReportController extends Controller
{
    public function Fashionsxlsx(FashionsXlsxService $service)
    {
        return $service->Fashionsxlsx();
    }


   
}
