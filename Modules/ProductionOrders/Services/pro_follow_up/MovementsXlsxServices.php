<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Excel;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\ProductionOrders\Exports\libraTransactionExport;
use Modules\ProductionOrders\Entities\Transaction;


class MovementsXlsxServices
{
  public $data;
    protected $xlsx;
    public function __construct(libraTransactionExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function libraTransactionxlsx()
    {

      return  Excel::download($this->xlsx, 'libraTransaction'.now().'.xlsx');

    }

}
