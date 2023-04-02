@extends('core::layouts.app')
@section('title')
    {{__('Admins')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">{{__('Admins')}}</h3>
                        @can('create-admin')
                            <a href="{{route('admins.create')}}"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                                {{__('Add New Admin')}}</a>
                        @endcan
                    </div>
                    <div class="col-12 mt-5 mb-3">
                        @include('core::search',['route'=>'admins'])
                    </div>

                    <div class="portlet-body table-responsive mt-4 data">
                        @include('admins::admins/table',['admins',$admins])
                    </div>

                </div>
                <!-- END Portlet -->

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>

        function disable_admin(id) {
            var val = ''
            if($("#switch_"+id).is(':checked')){
                val = 'on'
            }else{
                val = 'off'
            }

            var url = '{{route('admin.update.status','id')}}'
            url = url.replace('id', id)
            swal.fire({
                title: "{{__('Are you sure to change admin status?')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "",
                cancelButtonColor: "#d33",
                confirmButtonText: `

                    <form action="` + url + `" method="POST">
                        @method('PUT')
                @csrf
                <input type='hidden' name='active' value='`+val+`'>
                <button type='submit' class='btn btn-primary'>{{__('Yes, Change It!')}}</button>
                    </form>
                    `,
                cancelButtonText: "<button  class='btn btn-danger' onclick='window.location.href=window.location.href'>{{__('Cancel')}}</button>"
            })
        }


        function delete_admin(id) {

            var url = '{{route('admins.destroy','id')}}'
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
