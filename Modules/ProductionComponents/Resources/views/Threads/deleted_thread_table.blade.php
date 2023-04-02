<div id="refresh">
<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Thread ID')}}</th>
        <th>{{__('Thread Name')}}</th>
          @can('view-userCreater')
          <th>{{__('Deleted_by')}}</th>
          <th>{{__('Deleted_at')}}</th>
          @endcan
          @can('restore-thread')
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
            @can('view-userCreater')
            @if(!empty($thread->user->username))
            <td>{{$thread->user->username}}</td>
            <td>{{$thread->deleted_at}}</td>
            @else
            <td>{{__('Not Available')}}</td>
            <td>{{$thread->deleted_at}}</td>
            @endif
            @endcan
            @can('restore-thread')
                <td>
                    @can('restore-thread')  
                    <button class="btn btn-label-success btn-icon mr-1 ml-1"
                    onclick="restoreThread([{{$thread->id}}])" title={{__('Restore')}}>
                <i class="fas fa-window-restore"></i>
            </button>
                    @endcan
                </td>
            @endcan
             
        </tr>
    @endforeach
  
    </tbody>
</table>

{!! $threads['threads']->links('core::vendor.pagination.bootstrap-4') !!} 

</div>
