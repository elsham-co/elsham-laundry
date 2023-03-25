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
            @canany(['update-fabric','delete-fabric'])
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
                                     @if(!empty($fabcategory->user->username))
                            <td>{{$fabcategory->user->username}}</td>
                            <td>{{$fabcategory->created_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$fabcategory->created_at}}</td>
                           @endif
                        @endcan
                        @canany(['update-fabric','delete-fabric'])
                        <td>
                              @can('update-fabric')
                                <a href="{{route('Category.edit',$fabcategory->id)}}"
                                    class="btn btn-label-primary btn-icon mr-1 ml-1 mt-1" >
                                     <i class="fa fa-edit"></i>
                                 </a>
                        @endcan
                        @can('delete-fabric') 
                            <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                    id="delete_permission-{{$fabcategory->id}}"
                                    onclick="delete_fabric([{{$fabcategory->id}}])" title={{__('Delete')}}>
                                <i class="fa fa-trash"></i>
                            </button>
                        @endcan
                    </td>
                    @endcan
            </tr>
        @endforeach
        </tbody>
        </table>
    
    {!! $Allfabcategory['fabric_category']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>