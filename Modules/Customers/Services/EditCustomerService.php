<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserRepositoryEloquent;

class EditCustomerService
{
    public $user;
    public $customer_info;

    public function __construct(UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->user = $user;
        $this->customer_info = $customer_info;
    }

    public function editCustomer($customer)
    {
        $infoCustomers = $this->customer_info->where('customers_code',$customer->id)->get();

        $customer->info = $infoCustomers;
        return $customer;

    }

}
