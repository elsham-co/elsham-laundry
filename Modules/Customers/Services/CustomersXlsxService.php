<?php


namespace Modules\Customers\Services;


use Excel;
use Modules\Customers\Exports\CustomersExport;

class CustomersXlsxService
{
    protected $xlsx;
    public function __construct(CustomersExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Customersxlsx()
    {

      return  Excel::download($this->xlsx, 'Custmoers'.now().'.xlsx');
    }
}
