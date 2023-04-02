<div id="refresh">
<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Customer ID')}}</th>
        <th>{{__('Customer Name')}}</th>
        <th>{{__('Phone Number 1')}}</th>
        {{-- <th>{{__('Phone Number 2')}}</th> --}}
        <th>{{__('Email')}}</th>
        @can('view-userCreater')
              <th>{{__('Created_by')}}</th>
              <th>{{__('Created_at')}}</th>
              @endcan
        {{-- @canany(['update-customer','delete-customer']) --}}
            <th>{{__('Actions')}}</th>
        {{-- @endcan --}}
    </tr>
    </thead>
    <tbody>
    
    @foreach($customers as $key=> $customer)
        <tr style="text-align:center">
            <th scope="row">{{$key+1}}</th>
            <td>{{$customer->customers_code}}</td>
            <td>{{$customer->customers_name}}</td>
            <td>{{$customer->phone1}}</td>
            {{-- <td>{{$customer->phone2}}</td> --}}
            <td>{{$customer->email}}</td>
            @can('view-userCreater')
            @if(!empty($customer->user->username))
            <td>{{$customer->user->username}}</td>
            <td>{{$customer->created_at}}</td>
            @else
            <td>{{__('Not Available')}}</td>
            <td>{{$customer->created_at}}</td>
            @endif
        @endcan
            {{-- @canany(['update-customer','delete-customer']) --}}
                <td>
 
                    {{-- @can('update-customer') --}}

                        <a href="{{route('Customers.edit',$customer->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                            <i class="fa fa-edit"></i>
                        </a>
                    {{-- @endcan --}}
                    {{-- @can('delete-customer') --}}
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                id="delete_permission-{{$customer->id}}"
                                onclick="delete_customer([{{$customer->id}}])" title={{__('Delete')}}>
                            <i class="fa fa-trash"></i>
                        </button>
                    {{-- @endcan --}}

                </td>
            {{-- @endcan --}}
        </tr>
    @endforeach

    </tbody>
</table>
<div class="row">
    <div class="col-md-6">
{!! $customers->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}
<div class="col-md-1 col-xs-6" >
    <div class="form-group">
        <select name="rows" id="page" class="form-control">
            <option {{session()->get('row') == 10 ?'selected' :''}} value="10">10</option>
            <option {{session()->get('row') == 25 ?'selected' :''}} value="25">25</option>
            <option {{session()->get('row') == 50 ?'selected' :''}} value="50">50</option>
            <option {{session()->get('row')== 100 ?'selected' :''}} value="100">100</option>
        </select>
    </div>
</div>

</div>
</div>