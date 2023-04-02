<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Name')}}</th>
        @canany(['update-role','delete-role'])
            <th>{{__('Actions')}}</th>
        @endcan
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr style="text-align:center">
            <td>{{$role->id}}</td>
            <td>{{$role->role_name}}</td>
            @canany(['update-role','delete-role'])
                <td>
                    @can('update-role')

                        <a href="{{route('roles.edit',$role->id)}}" class="btn btn-label-primary btn-icon mr-1 ml-1">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete-role')

                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                id="delete_permission-{{$role->id}}"
                                onclick="delete_role([{{$role->id}}])"
                            {{-- {{$role->delete == 0 ? 'disabled':''}} --}}
                            >
                            <i class="fa fa-trash"></i>
                        </button>
                    @endcan

                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
<!-- END Datatable -->
{!! $roles->links('core::vendor.pagination.bootstrap-4') !!}
