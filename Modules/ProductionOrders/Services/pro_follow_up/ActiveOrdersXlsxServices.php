<?php


namespace Modules\ProductionOrders\Services\pro_follow_up;


use Excel;
use Modules\ProductionOrders\Repositories\pro_follow_up\StoreRepositoryEloquent;
use Modules\ProductionOrders\Exports\ActiveordersExport;
use Modules\ProductionOrders\Entities\Transaction;


class ActiveOrdersXlsxServices
{
  public $data;
    protected $xlsx;
    public function __construct(ActiveordersExport $xlsx)
    {
        $this->xlsx = $xlsx;
    }

    public function Activeordersxlsx()
    {

      return  Excel::download($this->xlsx, 'libra'.now().'.xlsx');

    }

}
