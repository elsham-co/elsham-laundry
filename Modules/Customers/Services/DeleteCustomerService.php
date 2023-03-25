<?php


namespace Modules\Customers\Services;


use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;

use Modules\Customers\Repositories\UserRepositoryEloquent;

class DeleteCustomerService
{
    public $user;

    public $customer_info;

    public function __construct(UserRepositoryEloquent $user,CustomerInfoRepositoryEloquent $customer_info)
    {
        $this->user = $user;
        $this->customer_info = $customer_info;
    }

    public function delete_customer($customer)
    {
        $this->customer_info->where('customers_code',$customer->id)->delete($customer);
        $customer->delete();
        $customer->deleted_by = auth()->user()->id;
;
        $customer->update();
    }

}
