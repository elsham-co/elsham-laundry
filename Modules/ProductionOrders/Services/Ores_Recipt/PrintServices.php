<?php

namespace Modules\ProductionOrders\Services\Ores_Recipt;

class PrintServices
{
    private $showOres;
    public function __construct(ShowOresServices $showOres)
    {
        $this->showOres = $showOres;
    }

    public function printOrder($id)
    {
        return $this->showOres->showOres($id);
    }
}
