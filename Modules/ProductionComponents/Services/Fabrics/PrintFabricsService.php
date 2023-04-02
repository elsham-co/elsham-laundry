<?php

namespace Modules\ProductionComponents\Services\Fabrics;
// use Modules\ProductionComponents\Services\Fabrics\FabricsServices;
class PrintFabricsService
{
    private $showOrder;
    public function __construct(FabricsServices $showOrder)
    {
        $this->showOrder = $showOrder;
    }

    public function printFabrics($request)
    {
        return $this->showOrder->get_printfabrics();
    }
}
