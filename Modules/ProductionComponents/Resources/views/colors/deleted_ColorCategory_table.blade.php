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
                @can('restore-colors')
                    <th>{{__('Actions')}}</th>
                @endcan
            </tr>
            </thead>
        <tbody>
            @foreach($Allcolcategory['colorscategory'] as $key=> $colcategory)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$colcategory->CategoryCol_code}}</td>
              
                <td>{{$colcategory->CategoryCol_name}}</td>
                @can('view-userCreater')
                            @if(!empty($colcategory->user->username))
                            <td>{{$colcategory->user->username}}</td>
                            <td>{{$colcategory->deleted_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$colcategory->deleted_at}}</td>
                           @endif
                        @endcan
                        @can('restore-colors')
                    <td>
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreColCategory([{{$colcategory->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>

                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Allcolcategory['colorscategory']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    