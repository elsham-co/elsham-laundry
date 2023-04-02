<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Fashion ID')}}</th>
            <th>{{__('Fashion Name')}}</th>
            <th>
                {{__('Fashion Category')}}
            
            </th>
            <th>{{__('Fashion Count')}}</th>
            @can('view-userCreater')
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  @endcan
                  @canany(['update-fashion','delete-fashion','components'])
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
          
        @foreach($Fashions['fashions_stages'] as $key=> $Fashion)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Fashion->fashioncode}}</td>
              
                <td>{{$Fashion->fashionname}}</td>
    
                <td dir="ltr">{{$Fashion->categoryfashions['fascategory_name']}}</td>
                <td>{{$Fashion->fashioncount}}</td>
                @can('view-userCreater')
                            <td>{{$Fashion->user->username}}</td>
    
                            <td>{{$Fashion->created_at}}</td>
                        @endcan
                           @canany(['update-fashion','delete-fashion','components'])
                        <td>  
                              @can('update-fashion')
                            <a href="{{route('Fashions.edit',$Fashion->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete-fashion') 
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                        id="delete_permission-{{$Fashion->id}}"
                        onclick="delete_fashion([{{$Fashion->id}}])" title={{__('Delete')}}>
                    <i class="fa fa-trash"></i>
                </button>
                        @endcan
                        @can('components')
                              <a href="{{route('fascategory.index')}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Category')}}>
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>
                            @endcan
                    </td>
                 @endcan
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Fashions['fashions_stages']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>