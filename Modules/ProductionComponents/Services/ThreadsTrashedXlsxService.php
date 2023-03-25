<?php


namespace Modules\ProductionComponents\Services;


use Excel;
use Modules\ProductionComponents\Exports\ThreadsExportTrashed;

class ThreadsTrashedXlsxService
{
    protected $xlsx;
    public function __construct(ThreadsExportTrashed $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function threadsTrashedxlsx()
    {

      return  Excel::download($this->xlsx, 'ThreadsTrashed.xlsx');
    }
}
