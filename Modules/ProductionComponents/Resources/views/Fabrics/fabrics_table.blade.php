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
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  @endcan
            {{-- @canany(['update-customer','delete-customer']) --}}
                <th>{{__('Actions')}}</th>
            {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
        @foreach($Fabrics['fabric'] as $key=> $Fabric)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Fabric->fabric_code}}</td>
              
                <td>{{$Fabric->fabricName}}</td>
    
                <td dir="ltr">{{$Fabric->categoryfabrics['Categoryfab_name']}}</td>
                       @can('view-userCreater')
                            <td>{{$Fabric->user->username}}</td>
    
                            <td>{{$Fabric->created_at}}</td>
                        @endcan
                        <td>
                            @can('view-fabric')

                            <a href="{{route('Fabrics.show',$Fabric->id)}}"
                               class="btn btn-label-secondary btn-icon mr-1 ml-1 mt-1">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endcan
                              @can('update-fabric')
                            <a href="{{route('Fabrics.edit',$Fabric->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete-fabric') 
                            <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                    id="delete_permission-{{$Fabric->id}}"
                                    onclick="delete_fabric([{{$Fabric->id}}])" title={{__('Delete')}}>
                                <i class="fa fa-trash"></i>
                            </button>
                        @endcan
                              <a href="{{route('Category.index')}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Category')}}>
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                    </td>
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Fabrics['fabric']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>