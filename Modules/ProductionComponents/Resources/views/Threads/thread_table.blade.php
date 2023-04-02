<div id="refresh">
<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Thread ID')}}</th>
        <th>{{__('Thread Name')}}</th>
        <th>{{__('Thread color')}}</th>
             @can('view-userCreater')
              <th>{{__('Created_by')}}</th>
              <th>{{__('Created_at')}}</th>
              @endcan
        @canany(['update-thread','delete-thread'])
            <th>{{__('Actions')}}</th>
        @endcan
    </tr>
    </thead>
    <tbody>
      
    @foreach($threads['threads'] as $key=> $thread)
    
        <tr style="text-align:center">
            
            <th scope="row">{{$key+1}}</th>
            
            <td>{{$thread->thread_code}}</td>
          
            <td>{{$thread->thread_name}}</td>

            <td dir="ltr">{{$thread->thread_color}}</td>
                    @can('view-userCreater')
                    @if(!empty($thread->user->username))
                        <td>{{$thread->user->username}}</td>
                        <td>{{$thread->created_at}}</td>
                        @else
                        <td>{{__('Not Available')}}</td>
                        <td>{{$thread->created_at}}</td>
                        @endif
                    @endcan
                    @canany(['update-thread','delete-thread'])
                    <td>
                        @can('update-thread') 
                        <a href="{{route('Threads.edit',$thread->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete-thread') 
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                id="delete_permission-{{$thread->id}}"
                                onclick="delete_thread([{{$thread->id}}])" title={{__('Delete')}}>
                            <i class="fa fa-trash"></i>
                        </button>
                    @endcan

                </td>
            @endcan
             
        </tr>
      
    @endforeach
  
    </tbody>
</table>

{!! $threads['threads']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
</p>
</div>