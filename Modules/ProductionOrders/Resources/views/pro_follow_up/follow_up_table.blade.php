<table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Customer Name')}}</th>
            <th>{{__('Production Order')}}</th>
            <th>{{__('Number Voucher')}}</th>
            <th>{{__('Fabrics Name')}}</th>
            <th>{{__('Weight')}}</th>
            <th>{{__('Fabrics Pieces')}}</th>
            <th>{{__('Colors')}}</th>
            <th>{{__('Fashion Count')}}</th>
            <th>{{__('Location')}}</th>
            <th>{{__('Prodction Date')}}</th>
            @can('edit_active_order')
            <th>{{__('Actions')}}</th>
            @endcan 
        </tr>
        </thead>
        <tbody>
          
        @foreach($activeorders['stores'] as $key=> $Singale_order)


            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{ $Singale_order->customer_info }}</td>
                <td>{{ $Singale_order->production_order }}</td>
                <td>{{ $Singale_order->number_voucher }}</td>
                <td>{{ $Singale_order->Fabric_info }}</td>
                <td>{{ $Singale_order->weight }}</td>
                <td>{{ $Singale_order->total }}</td>
                <td>{{ $Singale_order->Color_info }}</td>
                <td>{{ $Singale_order->totalfashion }}</td>
                <td>{{ $Singale_order->location }}</td>   
                <td>{{ $Singale_order->created_at }}</td>
               
                @can('edit_active_order')
              <td>
  
                  <a href="{{route('activeorder.edit',$Singale_order->production_order)}}"  class="btn btn-primary btn-sm" title={{__('transformation')}}>
                          <i class="fa fa-edit"></i>
                      </a>
              </td>
              @endcan              
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
   
        {!! $activeorders['stores']->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}