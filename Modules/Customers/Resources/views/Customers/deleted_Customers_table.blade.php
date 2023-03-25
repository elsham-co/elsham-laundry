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
                  {{-- @canany(['update-customer','delete-customer']) --}}
                  <th>{{__('Deleted_by')}}</th>
                  <th>{{__('Deleted_at')}}</th>
                  {{-- @endcan --}}
            {{-- @canany(['update-customer','delete-customer']) --}}
                <th>{{__('Actions')}}</th>
            {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
            @foreach($customers as $key=> $customer)
        {{-- @foreach($threads as $thread) --}}
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$customer->customers_code}}</td>
            <td>{{$customer->customers_name}}</td>
            <td>{{$customer->phone1}}</td>
            {{-- <td>{{$customer->phone2}}</td> --}}
            <td>{{$customer->email}}</td>
            {{-- @can('view-userCreater') --}}
            <td>{{$customer->user->username}}</td>
    
            <td>{{$customer->deleted_at}}</td>
        {{-- @endcan --}}
                      
                {{-- @canany(['update-customer','delete-customer']) --}}
                    <td>
                        {{-- @can('delete-thread')  --}}   
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreCustomer([{{$customer->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                        {{-- @endcan --}}
                    </td>
                {{-- @endcan --}}
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $customers->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    