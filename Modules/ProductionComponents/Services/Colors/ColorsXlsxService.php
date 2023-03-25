<?php


namespace Modules\ProductionComponents\Services\Colors;


use Excel;
use Modules\ProductionComponents\Exports\ColorsExport;

class ColorsXlsxService
{
    protected $xlsx;
    public function __construct(ColorsExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Colorsxlsx()
    {

      return  Excel::download($this->xlsx, 'Colors'.now().'.xlsx');
    }
}
