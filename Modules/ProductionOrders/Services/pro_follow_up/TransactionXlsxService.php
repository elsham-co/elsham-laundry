<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Excel;
use Modules\ProductionOrders\Repositories\pro_follow_up\TransactionRepositoryEloquent;
use Modules\ProductionOrders\Exports\TransactionExport;
use Modules\ProductionOrders\Entities\Transaction;


class TransactionXlsxService
{
  public $data;
    protected $xlsx;
    public function __construct(TransactionExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Transactionxlsx()
    {

      return  Excel::download($this->xlsx, 'Transaction'.now().'.xlsx');

    }

}
