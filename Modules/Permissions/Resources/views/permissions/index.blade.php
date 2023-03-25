@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/permissions-index.css')}}">
@endpush
@section('title')
    {{__('Permissions')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
              <div class="row">
                    <div class="portlet-header col-12">
               
                <div class="col-9">
                        <h3 class="far fa-eye-slash">{{__('Permissions')}}</h3>
                        @can('permissions')
                     
                        @endcan
                    </div>
                    <div class="col" >
                        <a href="#" class="btn btn-label-primary mr-1 ml-1 fa fa-plus" data-toggle="modal"
                        data-target="#create_permission" title={{__('Add New Permission')}} style="font-size: 16px;">
                            {{__('New Permission')}}
                        </a>
                    </div>
                    </div>

                </div>
                    <div class="col-12 mt-5 mb-3">
                        @include('core::search',['route'=>'permissions'])
                    </div>
                    <div class="portlet">
                    <div class="portlet-body table-responsive mt-4">
                        <!-- BEGIN Datatable -->
                        <table id="datatable-3" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr style="text-align:center">
                                <th>#</th>
                                <th>{{__('Name')}}</th>

                                @can('permissions')
                                <th>{{__('Actions')}}</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr style="text-align:center">
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->permission_name}}</td>
                                    @can('permissions')
                                    <td>

                                        <button class="btn btn-label-primary btn-icon mr-1 ml-1" id="update_per"
                                                data-permission_id="{{$permission->id}}"
                                                data-permission_name_ar="{{$permission->name_ar}}" data-toggle="modal"
                                                data-target="#edit_permission">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                                                id="delete_permission-{{$permission->id}}"
                                                onclick="delete_permission([{{$permission->id}}])">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- END Datatable -->
                        {!! $permissions->withQueryString()->links('core::vendor.pagination.simple-tailwind') !!}
                        
                    </div>
                </div>
                <!-- END Portlet -->

            </div>
            @include('permissions::permissions.modals.create_modal')
            @include('permissions::permissions.modals.update_modal')
        </div>
    </div>

@endsection
@push('js')
    <script>
         
        function delete_permission(id) {

            var url = '{{route('permissions.destroy','id')}}'
            url = url.replace('id', id)
            swal.fire({
                title: "{{__('Are you sure?')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "",
                cancelButtonColor: "#d33",
                confirmButtonText: `

                    <form action="` + url + `" method="POST">
                        @method('DELETE')
                @csrf
                <button type='submit' class='btn btn-primary'>{{__('Yes, Delete It!')}}</button>
                    </form>
                    `,
                cancelButtonText: "<button  class='btn btn-danger'>{{__('Cancel')}}</button>"
            })
        }
    </script>
@endpush
