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
                      @can('restore-fashion')
                    <th>{{__('Actions')}}</th>
                @endcan
            </tr>
            </thead>
        <tbody>
            @foreach($Allfascategory['fashioncategory'] as $key=> $fascategory)
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$fascategory->fascategory_code}}</td>
              
                <td>{{$fascategory->fascategory_name}}</td>
                @can('view-userCreater')
                @if(!empty($fascategory->user->username))
                            <td>{{$fascategory->user->username}}</td>
                            <td>{{$fascategory->deleted_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$fascategory->deleted_at}}</td>
                            @endif
                        @endcan
                        @can('restore-fashion') 
                    <td>
                        
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreFasCategory([{{$fascategory->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Allfascategory['fashioncategory']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    