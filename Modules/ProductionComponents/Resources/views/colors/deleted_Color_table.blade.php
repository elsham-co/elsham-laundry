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
              @can('restore-colors')
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
            @foreach($Colors['colors_stages'] as $key=> $Color)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Color->colorcode}}</td>
              
                <td>{{$Color->colorname}}</td>
    
                <td dir="ltr">{{$Color->categorycolors['CategoryCol_name']}}</td>
                @can('view-userCreater')
                @if(!empty($Color->user->username))
                <td>{{$Color->user->username}}</td>
                <td>{{$Color->deleted_at}}</td>
                @else
                <td>{{__('Not Available')}}</td>
                <td>{{$Color->deleted_at}}</td>
               @endif
                        @endcan
                      
                        @can('restore-colors')
                    <td>
                        <button class="btn btn-label-success btn-icon mr-1 ml-1"
                        onclick="restoreColor([{{$Color->id}}])" title={{__('Restore')}}>
                    <i class="fas fa-window-restore"></i>
                </button>
                    </td>
                @endcan
                 
            </tr>
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Colors['colors_stages']->links('core::vendor.pagination.bootstrap-4') !!} 
    
    </div>
    