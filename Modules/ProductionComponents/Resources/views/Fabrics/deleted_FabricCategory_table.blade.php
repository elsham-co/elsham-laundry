<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
            <tr style="text-align:center">
                <th>#</th>
                <th>{{__('Category ID')}}</th>
                <th>{{__('Category Name')}}</th>
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
            @foreach($Allfabcategory['fabric_category'] as $key=> $fabcategory)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$fabcategory->Categoryfab_code}}</td>
              
                <td>{{$fabcategory->Categoryfab_name}}</td>
    
                @can('view-userCreater')
                            <td>{{$fabcategory->user->username}}</td>
    
                            <td>{{$fabcategory->deleted_at}}</td>
                        @endcan
                        @can('restor-fabric')
                    <td>  
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreFabCategory([{{$fabcategory->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Allfabcategory['fabric_category']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    