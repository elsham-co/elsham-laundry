<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Fabrics ID')}}</th>
            <th>{{__('Fabrics Name')}}</th>
            <th>
                {{__('Fabrics Category')}}
            
            </th>
            @can('view-userCreater')
              <th>{{__('Deleted_by')}}</th>
              <th>{{__('Deleted_at')}}</th>
              @endcan
            @can('restor-fabric')
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
            @foreach($DeletedFabrics['fabric'] as $key=> $Fabric)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Fabric->fabric_code}}</td>
              
                <td>{{$Fabric->fabricName}}</td>
                <td dir="ltr">{{$Fabric->categoryfabrics['Categoryfab_name']}}</td>
                @can('view-userCreater')
                @if(!empty($Fabric->user->username))
                <td>{{$Fabric->user->username}}</td>
                <td>{{$Fabric->deleted_at}}</td>
                @else
                <td>{{__('Not Available')}}</td>
                <td>{{$Fabric->deleted_at}}</td>
               @endif
            @endcan
                @can('restor-fabric')
                    <td>  
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreFabric([{{$Fabric->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $DeletedFabrics['fabric']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    