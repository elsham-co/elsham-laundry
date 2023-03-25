<?php


namespace Modules\ProductionComponents\Services\Fabrics;


use Excel;
use Modules\ProductionComponents\Exports\FabricsExport;

class FabricsXlsxService
{
    protected $xlsx;
    public function __construct(FabricsExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Fabricsxlsx()
    {

      return  Excel::download($this->xlsx, 'Fabrics'.now().'.xlsx');
    }
}
