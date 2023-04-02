<?php


namespace Modules\Core\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Core\Entities\Order;
use Modules\Core\Repositories\UserRepositoryEloquent;

class DashboardService
{
    public $user_repository;
    public $group_repository;
    public $order_item_repository;
    public $product_repository;
    public $product_data_repository;
    public $order_repository;
    public $aws;



    public function __construct(
        UserRepositoryEloquent $userRepositoryEloquent
    ) {
        $this->user_repository = $userRepositoryEloquent;
    }

    public function dashboard()
    {
        $data = [];
        return $data;
    }
}