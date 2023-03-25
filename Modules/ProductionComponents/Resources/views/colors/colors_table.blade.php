<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Color ID')}}</th>
            <th>{{__('Colors Name')}}</th>
            <th>
                {{__('Colors Category')}}
            
            </th>
            @can('view-userCreater')
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  @endcan
            @canany(['update-colors','delete-colors','components'])
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
                            <td>{{$Color->created_at}}</td>
                            @else
                            <td>{{__('Not Available')}}</td>
                            <td>{{$Color->created_at}}</td>
                            @endif
                        @endcan
                        @canany(['update-colors','delete-colors','components'])
                        <td>
                              @can('update-colors')
                            <a href="{{route('colors.edit',$Color->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete-colors') 
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                        id="delete_permission-{{$Color->id}}"
                        onclick="delete_color([{{$Color->id}}])" title={{__('Delete')}}>
                    <i class="fa fa-trash"></i>
                </button>
                        @endcan
                              <a href="{{route('ccategory.index')}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Category')}}>
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                    </td>
                    @endcan
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Colors['colors_stages']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>