<?php

namespace Modules\Customers\Services;

use Modules\Core\Repositories\UserRepositoryEloquent;
use Modules\Orders\Repositories\OrderItemRepositoryEloquent;
use Modules\Orders\Repositories\OrderRepositoryEloquent;
use Modules\Orders\Repositories\PaymentMethodRepositoryEloquent;
use Modules\Vendors\Repositories\VendorInfoRepositoryEloquent;
use Modules\Orders\Services\OrderVendorService;
use Modules\Orders\Services\OrderFiltrationService;


class CustomersOrdersService
{
    protected $order;
    protected $orderItems;
    protected $user;
    protected $orderVendor;
    protected $payment;
    protected $filterData;

    public function __construct(OrderRepositoryEloquent $order,OrderItemRepositoryEloquent $orderItems,
                                UserRepositoryEloquent $user,OrderVendorService $orderVendor,
                                PaymentMethodRepositoryEloquent $payment,OrderFiltrationService $filterData)
    {
        $this->order = $order;
        $this->user = $user;
        $this->filterData = $filterData;
        $this->payment = $payment;
        $this->orderVendor = $orderVendor;
        $this->orderItems = $orderItems;
    }


    public function orders($user,$data=[])
    {
        $allData = [];
        $orders = $this->order;
        if(!empty($data['search'])) {
            $orders = $orders->where('id', $data['search'])->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->where('username', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('full_name', 'LIKE', '%' . $data['search'] . '%');
                })->orwhereHas('author', function ($query) use ($data) {
                    $query->where('username', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('full_name', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }


        if(!empty($data['date_from']) && !empty($data['date_to'])){
            $dateFrom = strtotime($data['date_from']);
            $dateTo = strtotime($data['date_to']);
            $from = date('Y-m-d',$dateFrom);
            $to = date('Y-m-d',$dateTo+86400);
            $orders = $orders->whereBetween('order_date', [$from, $to]);
        }

        $orders = $orders->where('user_id',$user->id);
        
        if(!empty($data['author'])){
            $orders = $orders->where('author',$data['author']);
        }
        if(!empty($data['status'])){
            $orders = $orders->where('status',$data['status']);
        }
        if(!empty($data['payment'])){
            $orders = $orders->where('payment_method_id',$data['payment']);
        }
        if(!empty($data['vendor'])){
            $orders = $orders->whereHas('products', function ($query) use ($data) {
                $query->where('vendor_id',$data['vendor']);
            });
        }

        if(!empty($data['orderby'])) {
            $orderType = !empty($data['order']) ? $data['order'] : 'desc';
            if ($data['orderby'] == 'id') {
                $orderBy = 'id';
            } elseif ($data['orderby'] == 'order_date') {
                $orderBy = 'order_date';
            } elseif ($data['orderby'] == 'total_amount') {
                $orderBy = 'total_amount';
            } else {
                $orderBy = 'id';
            }
            $totalAmount = $orders->sum('total_amount');
            $totalOrders = $orders->count();
            $orders = $orders->orderBy($orderBy,$orderType)->paginate(10);

        } else{
            $totalAmount = $orders->sum('total_amount');
            $totalOrders = $orders->count();
            $orders = $orders->orderBy('id','desc')->paginate(10);
        }

        foreach($orders as $order)
        {
            $order->user = $this->user->where('id',$order->user_id)->first();
            $order->added_by = $this->user->where('id',$order->author)->first();
            $order->payment = $this->payment->where('id',$order->payment_method_id)->first();
            $order->vendors = $this->orderVendor->orderVendors($order->id);
        }

        $filter = $this->filterData->filtrationData();

        $allData['orders'] = $orders;
        $allData['totalAmount'] = $totalAmount;
        $allData['totalOrders'] = $totalOrders;
        $allData['admins'] = $filter['admins'];
        $allData['vendors'] = $filter['vendors'];
        $allData['payments'] = $filter['payments'];

        return $allData;
    }
}