@extends('core::layouts.app')
@section('title')
    {{__('Create Admin')}}
@endsection
@section('content')

    <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
            <h3 class="portlet-title">{{__('Create New Admin')}}</h3>
        </div>
        <div class="portlet-body">
            <form action="{{route('admins.store')}}" method="POST" id="create_admin">
            @csrf
            <!-- BEGIN Form Group -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{__('Full Name')}}</label>
                            <input type="text" class="form-control" name="full_name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Username')}}</label>
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Email')}}</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Phone Number')}}</label>
                                    <input type="number" class="form-control" name="phone">
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
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="roles">{{__('Roles')}}</label>
                            <select  name="roles[]" class="form-control select2"  id="roles" multiple>
                                @foreach($roles as $key=>$role)
                                    <option value="{{$key}}">{{$role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary btn-lg">{{__('Create')}}</button>
                    <a href="{{route('admins.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                </div>

            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $("#roles").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
            })

            $("#roles").validate().settings.ignore=[];

            $("#create_admin").validate({
                ignore: 'input[type=hidden]',
                rules:{
                    username:'required',
                    password:'required',
                    email:'required',
                    full_name:'required',
                    "roles[]":'required'
                },
                messages:{
                    username:'{{__('username is Required')}}',
                    full_name:'{{__('Full Name is Required')}}',
                    password:'{{__('password is Required')}}',
                    email:'{{__('email is Required')}}',
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
