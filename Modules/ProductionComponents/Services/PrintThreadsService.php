<?php

namespace Modules\ProductionComponents\Services;

class PrintThreadsService
{
    private $showOrder;
    public function __construct(ThreadService $showOrder)
    {
        $this->showOrder = $showOrder;
    }

    public function printOrder($request)
    {
        return $this->showOrder->get_threads();
    }
}
