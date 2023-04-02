<?php

namespace Modules\ProductionComponents\Services\Colors;

class PrintcolorServices
{
    private $showOrder;
    public function __construct(ColorStagesServices $showOrder)
    {
        $this->showOrder = $showOrder;
    }

    public function printColors($request)
    {
        return $this->showOrder->get_printcolors();
    }
}
