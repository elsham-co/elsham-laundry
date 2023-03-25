
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
          <th>{{__('Libra Store')}}</th>
          <th>{{__('Hall1')}}</th>
          <th>{{__('Hall2')}}</th>
          <th>{{__('Hall3')}}</th>
        <th>{{__('Prodction Date')}}</th>

          <th>{{__('Actions')}}</th>
      </tr>
      </thead>
      <tbody>
        
      @foreach($Movements['stores'] as $key=> $Singale_movement)
      

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
              <td>@if( $Singale_movement->store1==1 ) الارض  {{ $Singale_movement->stage1 }} @else <p style="background: rgb(25, 167, 255);text-align: center">--</p> @endif</td>
              <td>@if( $Singale_movement->store1==117 )   {{ $Singale_movement->stage1 }} @else <p style="background: rgb(25, 167, 255);text-align: center">--</p> @endif</td>
              <td>@if( $Singale_movement->store1==118 )   {{ $Singale_movement->stage1 }} @else <p style="background: rgb(25, 167, 255);text-align: center">--</p> @endif</td>
              <td>@if( $Singale_movement->store1==119 )   {{ $Singale_movement->stage1 }} @else <p style="background: rgb(25, 167, 255);text-align: center">--</p> @endif</td>
              <td>{{ $Singale_movement->created_at }}</td>
              {{-- <td>{{ $info->note }}</td> --}}
              <!-- @canany(['create_transaction','edit_transaction']) -->
              <td>
                @can('create_transaction')
                      <a href="{{route('pro_follow_up.edit',$Singale_movement->production_order)}}"  class="btn btn-primary btn-sm" title={{__('transformation')}}>
                          <i class="fa">{{__('Transformation')}}</i>
                      </a>
                @endcan
                <a href="{{route('transaction.show',$Singale_movement->production_order)}}"  class="btn btn-primary btn-sm" title="حركه امر الشغل">
                    <i class="fa fa-eye"></i>
                </a>
              </td>
              <!-- @endcan -->
               
          </tr>
        
      @endforeach
    
      </tbody>
  </table>
  
  {!! $Movements['stores']->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}
 