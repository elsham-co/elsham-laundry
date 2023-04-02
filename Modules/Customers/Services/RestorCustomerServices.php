<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;

class RestorCustomerServices
{

    protected $Customers_info;

    public function __construct(CustomerInfoRepositoryEloquent $Customers_info)
    {
        $this->Customers_info = $Customers_info;
    }

    public function restoreCustomers($id)
    {
        $restorecode= $this->Customers_info->withTrashed()->where('id',$id)->first();

        $this->Customers_info->where('customers_code',$restorecode->customers_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();

    }
}