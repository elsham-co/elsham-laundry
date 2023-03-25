<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Category ID')}}</th>
            <th>{{__('Category Name')}}</th>
            @can('view-userCreater')
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  @endcan
                  @canany(['update-fashion','delete-fashion'])
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
                            <td>{{$fascategory->created_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$fascategory->created_at}}</td>
                           @endif
                            @endcan
                            @canany(['update-fashion','delete-fashion'])
                        <td>
                            @can('update-fashion')
                                <a href="{{route('fascategory.edit',$fascategory->id)}}"
                                    class="btn btn-label-primary btn-icon mr-1 ml-1 mt-1" >
                                     <i class="fa fa-edit"></i>
                                 </a>
                        @endcan
                        @can('delete-fashion') 
                            <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                    id="delete_permission-{{$fascategory->id}}"
                                    onclick="delete_FastionCategory([{{$fascategory->id}}])" title={{__('Delete')}}>
                                <i class="fa fa-trash"></i>
                            </button>
                        @endcan
                    </td>
                @endcan
                 
            </tr>
        @endforeach
        </tbody>
        </table>
    
    {!! $Allfascategory['fashioncategory']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>