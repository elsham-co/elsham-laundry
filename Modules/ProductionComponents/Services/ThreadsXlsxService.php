<?php


namespace Modules\ProductionComponents\Services;


use Excel;
use Modules\ProductionComponents\Exports\ThreadsExport;

class ThreadsXlsxService
{
    protected $xlsx;
    public function __construct(ThreadsExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function threadsxlsx()
    {

      return  Excel::download($this->xlsx, 'Threads.xlsx');
    }
}
