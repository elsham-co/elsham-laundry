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
           @canany(['update-colors','delete-colors'])
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
                            <td>{{$colcategory->created_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$colcategory->created_at}}</td>
                            @endif
                        @endcan
                      @canany(['update-colors','delete-colors'])
                        <td>
                              @can('update-colors')
                                <a href="{{route('ccategory.edit',$colcategory->id)}}"
                                    class="btn btn-label-primary btn-icon mr-1 ml-1 mt-1" >
                                     <i class="fa fa-edit"></i>
                                 </a>
                        @endcan
                        @can('delete-colors') 
                            <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                    id="delete_permission-{{$colcategory->id}}"
                                    onclick="delete_ColorCategory([{{$colcategory->id}}])" title={{__('Delete')}}>
                                <i class="fa fa-trash"></i>
                            </button>
                        @endcan
                    </td>
                @endcan
                 
            </tr>
        @endforeach
        </tbody>
        </table>
    
    {!! $Allcolcategory['colorscategory']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>