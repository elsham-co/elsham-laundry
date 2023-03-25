@extends('core::layouts.app')
@section('title')
    {{__('Roles')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">{{__('Roles')}}</h3>
                        @can('create-role')
                            <a href="{{route('roles.create')}}"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                                {{__('Add New Role')}}</a>
                        @endcan
                    </div>
                    <div class="col-12 mt-5 mb-3">
                        @include('core::search',['route'=>'roles'])
                    </div>
                    <div class="portlet-body table-responsive mt-4 data">
                        @include('roles::roles/role_table',['roles'=>$roles])
                    </div>

                </div>
                <!-- END Portlet -->

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        function delete_role(id) {

            var url = '{{route('roles.destroy','id')}}'
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
