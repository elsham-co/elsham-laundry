<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Fashion ID')}}</th>
            <th>{{__('Fashion Name')}}</th>
            <th>
                {{__('Fashion Category')}}
            
            </th>
            <th>{{__('Fashion Count')}}</th>
                  @can('view-userCreater')
                  <th>{{__('Deleted_by')}}</th>
                  <th>{{__('Deleted_at')}}</th>
                  @endcan
          @can('restore-fashion')
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
            @foreach($Fashions['fashions_stages'] as $key=> $Fashion) 
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Fashion->fashioncode}}</td>
              
                <td>{{$Fashion->fashionname}}</td>
    
                <td dir="ltr">{{$Fashion->categoryfashions['fascategory_name']}}</td>
                <td>{{$Fashion->fashioncount}}</td>
                   @can('view-userCreater')
                            @if(!empty($Fashion->user->username))
                            <td>{{$Fashion->user->username}}</td>
                            <td>{{$Fashion->deleted_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$Fashion->deleted_at}}</td>
                           @endif
                        @endcan
                        @can('restore-fashion')
                    <td>
 
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreFashion([{{$Fashion->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Fashions['fashions_stages']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    