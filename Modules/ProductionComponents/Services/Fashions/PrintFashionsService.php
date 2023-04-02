<?php

namespace Modules\ProductionComponents\Services\Fashions;

class PrintFashionsService
{
    private $showOrder;
    public function __construct(FashionStagesServices $showOrder)
    {
        $this->showOrder = $showOrder;
    }

    public function printFashions($request)
    {
        return $this->showOrder->get_printfashions();
    }
}
