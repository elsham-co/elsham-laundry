<?php

namespace Modules\Customers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Services\CustomersXlsxService;

class CustomersExpertReportController extends Controller
{
    public function Customersxlsx(CustomersXlsxService $service)
    {
        return $service->Customersxlsx();
    }


   
}
