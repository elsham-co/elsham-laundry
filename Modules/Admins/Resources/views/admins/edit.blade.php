@extends('core::layouts.app')
@section('title')
    {{__('Edit Admin')}}
@endsection
@section('content')

    <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
            <h3 class="portlet-title">{{__('Edit Admin')}}</h3>
        </div>
        <div class="portlet-body">
            <form action="{{route('admins.update',$admin->id)}}" method="POST" id="edit_admin">
            @method('PUT')
            @csrf
            <!-- BEGIN Form Group -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Full Name')}}</label>
                                    <input type="text" class="form-control" value="{{$admin->full_name}}" name="full_name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Username')}}</label>
                                    <input type="text" class="form-control" value="{{$admin->username}}" name="username">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Phone Number')}}</label>
                                    <input type="number" class="form-control" value="{{$admin->phone ??''}}" name="phone">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Password')}}</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role_select_edit">{{__('Roles')}}</label>
                            <select  name="roles[]" class="form-control select2"  id="role_select_edit" multiple>
                                @foreach($admin->roles as $key=> $role)
                                    <option value="{{$key}}"

                                        @foreach($admin->role as $key=> $selected_role)
                                            @if($selected_role == $role)
                                                selected
                                            @endif
                                        @endforeach
                                    >{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary btn-lg">{{__('Update')}}</button>
                    <a href="{{route('admins.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                </div>

            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $("#role_select_edit").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
            })

            $("#role_select_edit").validate().settings.ignore=[];

            $("#edit_admin").validate({
                ignore: 'input[type=hidden]',
                rules:{
                    username:'required',
                    full_name:'required',
                    "roles[]":'required'
                },
                messages:{
                    username:'{{__('Username is required')}}',
                    full_name:'{{__('Full Name is Required')}}',
                    "roles[]":'{{__('Role is required')}}',
                },
                errorPlacement: function (error, element) {
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        error.insertAfter(element.next('.select2-container'));
                    }else{
                        error.insertAfter(element.parent());
                    }
                }
            })


        })

    </script>
@endpush
