@extends('core::layouts.app')
@section('title')
    {{__('Create Role')}}
@endsection
@section('content')

    <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
            <h3 class="portlet-title">{{__('Create New Role')}}</h3>
        </div>
        <div class="portlet-body">
            <form action="{{route('roles.store')}}" method="POST" id="create_role">
                @csrf
                <!-- BEGIN Form Group -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">{{__('Name En')}}</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">{{__('Name Ar')}}</label>
                                        <input type="text" class="form-control" name="name_ar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="permissions">{{__('Permissions')}}</label>
                                <select multiple="multiple" name="permissions[]" class="form-control select2"  id="permissions">
                                    @foreach($data['permissions'] as $key=> $permission)
                                    <option value="{{$key}}">{{$permission}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">{{__('Users')}}</label>
                                <select multiple="multiple" name="users[]" class="form-control"  id="user_select">
                                    @foreach($data['users'] as $user)
                                        <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button class="btn btn-primary btn-lg">{{__('Create')}}</button>
                        <a href="{{route('roles.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                    </div>

            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#permissions").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
                closeOnSelect: false,
            })
            $("#user_select").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
                closeOnSelect: false,
            })


            $("#create_role").validate({
                ignore: 'input[type=hidden]',
                rules:{
                    name:'required',
                    name_ar:'required',
                    "permissions[]":'required',
                },
                messages:{
                    name:'{{__('Role English name is Required')}}',
                    name_ar:'{{__('Role Arabic name is Required')}}',
                    "permissions[]":'{{__('Permissions is required')}}',
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
