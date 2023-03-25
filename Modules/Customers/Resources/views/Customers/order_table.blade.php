
<h4>{{__('Total number of order')}} : <span id="totalorders"> {{$orders['totalOrders']}} </span> </h4>

<h4>{{__('Total amount of the orders')}} : <span id="totalamount"> {{$orders['totalAmount']}}  </h4>

<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Vendors')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Payment Method')}}</th>
        <th>{{__('Total')}}</th>
        <th>{{__('Order Qrcode')}}</th>
        <th>{{__('Added By')}}</th>
        @canany(['update-order','delete-order'])
            <th>{{__('Actions')}}</th>
        @endcan
    </tr>
    </thead>
    <tbody>
    @foreach($orders['orders'] as $key=> $order)

        <tr style="text-align:center">
            <td>
                <input class="preperation-checkbox" type="checkbox"  value="{{$order->id}}" >
                {{$order->id}}
            </td>
            <td>
                @foreach($order->vendors as $vendor)
                    <span class="badge badge-primary badge-lg">{{$vendor->shop_name??''}}</span>
                @endforeach
            </td>

            <td>{{$order->order_date}}</td>
            <td>
                @if ($order->status == 0)
                    <span class="badge bg-light text-dark">{{__('Pending')}}</span>
                @elseif ($order->status == 1)
                    <span class="badge bg-info text-dark">{{__('Processing')}}</span>
                @elseif ($order->status == 6)
                    <span class="badge bg-secondary">{{__('Ready To Ship')}}</span>
                @elseif ($order->status == 2)
                    <span class="badge bg-primary">{{__('Shipped')}}</span>
                @elseif ($order->status == 3)
                    <span class="badge bg-success">{{__('Completed')}}</span>
                @elseif ($order->status == 4)
                    <span class="badge bg-danger">{{__('Cancelled')}}</span>
                @elseif ($order->status == 7)
                    <span class="badge bg-warning text-dark">{{__('Partially Refunded')}}</span>
                @elseif ($order->status == 5)
                    <span class="badge bg-danger">{{__('Refunded')}}</span>
                @endif
            </td>
            <td>{{$order->payment->payment_method_title??''}}</td>
            <td>{{$order->total_amount}}</td>
            <td>
                @if(!empty($order->qrcode))
                    <button class="btn btn-primary" onclick="printQrcode({{$order->id}},{{$order->qrcode}})">{{__('Print')}}</button>

                    <div  id="order_qr_{{$order->id}}" class="print-qr mt-2"
                          style="display: flex; justify-content: center; text-align: center;
                           margin: 50% !important;"
                          hidden></div>
                @else
                    {{__('Not Found')}}
                @endif
            </td>
            <td>
                @if($order->added_by)
                    {{ $order->added_by->first_name .' '. $order->added_by->last_name }}
                @endif
            </td>


            @canany(['update-order','delete-order','view-order'])
                <td>
                    @can('view-order')

                        <a href="{{route('orders.show',$order->id)}}"
                           class="btn btn-label-secondary btn-icon mr-1 ml-1 mt-1">
                            <i class="fa fa-eye"></i>
                        </a>
                    @endcan
                    <!-- @can('update-order')

                        <a href="{{route('orders.edit',$order->id)}}"
                           class="btn btn-label-primary btn-icon mr-1 ml-1 mt-1">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete-order')
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1 mt-1"
                                onclick="delete_order([{{$order->id}}])">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endcan
                    @can('update-order')

                        <a href="{{route('refund.request.create',$order->id)}}"
                           class="btn btn-label-dark btn-icon mr-1 ml-1 mt-1">
                            <i class="fas fa-backward"></i>
                    @endcan -->

                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
{!! $orders['orders']->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}
