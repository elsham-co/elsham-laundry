<table id="datatable-3" class="table table-bordered table-striped table-hover">
    <thead>
    <tr style="text-align:center">
        <th>#</th>
        <th>{{__('Username')}}</th>
        <th>{{__('Email')}}</th>
        <th>{{__('Phone Number')}}</th>
        <th>{{__('Status')}}</th>
        <th>{{__('Roles')}}</th>
        @canany(['update-admin','delete-admin'])
            <th>{{__('Actions')}}</th>
        @endcan
    </tr>
    </thead>
    <tbody >
    @foreach($admins as $admin)
        <tr style="text-align:center">
            <td>{{$admin->id}}</td>
            <td>{{$admin->username}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->phone}}</td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" onchange="disable_admin([{{$admin->id}}])" role="switch" id="switch_{{$admin->id}}"
                           {{$admin->active == 1 ?'checked' :''}}
                           @can('update-status-admin') @else disabled @endcan
                    >
                </div>
            </td>
            <td>
                @foreach($admin->role as $role)
                    <span class="badge badge-primary badge-lg">{{$role}}</span>
                @endforeach
            </td>
            @canany(['update-admin','delete-admin'])
                <td>
                    @can('update-admin')

                        <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-label-primary btn-icon mr-1 ml-1">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete-admin')
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                id="delete_permission-{{$admin->id}}"
                                onclick="delete_admin([{{$admin->id}}])">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endcan

                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    {!! $admins->links('core::vendor.pagination.bootstrap-4') !!}
</div>
