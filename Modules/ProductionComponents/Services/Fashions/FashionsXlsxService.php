<?php


namespace Modules\ProductionComponents\Services\Fashions;


use Excel;
use Modules\ProductionComponents\Exports\FashionsExport;

class FashionsXlsxService
{
    protected $xlsx;
    public function __construct(FashionsExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Fashionsxlsx()
    {

      return  Excel::download($this->xlsx, 'Fashions'.now().'.xlsx');
    }
}
