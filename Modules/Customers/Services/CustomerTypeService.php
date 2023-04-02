<?php

namespace Modules\Customers\Services;

use Modules\Customers\Repositories\CustomerInfoRepositoryEloquent;
use Modules\Customers\Repositories\UserGroupRepositoryEloquent;

class CustomerTypeService
{
    private $userGroup;

    public function __construct(UserGroupRepositoryEloquent $userGroup,CustomerInfoRepositoryEloquent $customerInfo)
    {
        $this->userGroup = $userGroup;
    }

    public function changeTypeCustomer($customer,$data)
    {
        $type = $this->userGroup->where('user_id',$customer->id)->first();
        $type->update([
            'group_id'=>$data['active'] == 'on'? 4:2
        ]);

    }

}
