
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
      <th>{{__('Delivery Date')}}</th>
        <th>{{__('Actions')}}</th>
    </tr>
    </thead>
    <tbody>
      
    @foreach($quality_deliveries['stores'] as $key=> $Singale_movement)
    

        <tr style="text-align:center">
            
            <th scope="row">{{$key+1}}</th>
            
            <td>{{ $Singale_movement->customer_info }}</td>
            <td>{{ $Singale_movement->production_order }}</td>
            <td>{{ $Singale_movement->number_voucher }}</td>
            <td>{{ $Singale_movement->Fabric_info }}</td>
            <td>{{ $Singale_movement->weight }}</td>
            <td>{{ $Singale_movement->total }}</td>
           <td>{{ $Singale_movement->Color_info }}</td>
            <td>{{ $Singale_movement->totalfashion }}</td>
            <td>{{ $Singale_movement->updated_at }}</td>
            {{-- <td>{{ $info->note }}</td> --}}
            <!-- @canany(['create_transaction','view_active_order']) -->
            <td>
                <a href="{{route('transaction.show',$Singale_movement->production_order)}}"  class="btn btn-primary btn-sm"title={{__('Follow-up stages-Movement')}}>
                  <i class="fa fa-eye"></i>
              </a>
            </td>
            <!-- @endcan -->
             
        </tr>
      
    @endforeach
  
    </tbody>
</table>

{!! $quality_deliveries['stores']->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}
