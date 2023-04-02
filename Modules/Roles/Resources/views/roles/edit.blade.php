@extends('core::layouts.app')
@section('title')
    {{__('Edit Role')}}
@endsection
@section('content')

    <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
            <h3 class="portlet-title">{{__('Edit Role')}}</h3>
        </div>
        <div class="portlet-body">
            <form action="{{route('roles.update',$data['role']['id'])}}" method="POST" id="update_role">
            @method('PUT')
            @csrf
            <!-- BEGIN Form Group -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Name En')}}</label>
                                    <input type="text" class="form-control" value="{{$data['role']->name}}" name="name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">{{__('Name Ar')}}</label>
                                    <input type="text" class="form-control" value="{{$data['role']->name_ar}}" name="name_ar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">{{__('Permissions')}}</label>
                            <select multiple="multiple" name="permissions[]" class="form-control select2"  id="exampleFormControlSelect2">
                                @foreach($data['permissions'] as $permission)
                                    <option value="{{$permission->id}}"

                                        @foreach($data['selected_permissions'] as $selected_permission)
                                            @if($selected_permission == $permission->id)
                                                selected
                                            @endif
                                         @endforeach

                                    >{{$permission->permission_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">{{__('Users')}}</label>
                            <select multiple="multiple" name="users[]" class="form-control"  id="user_select">
                                @foreach($data['users'] as $user)

                                    <option value="{{$user->id}}"

                                            @foreach($data['selected_users'] as $selected_user)
                                            @if($selected_user->id == $user->id)
                                            selected
                                        @endif
                                        @endforeach


                                    >{{$user->username}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary btn-lg">{{__('Update')}}</button>
                    <a href="{{route('roles.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                </div>

            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#exampleFormControlSelect2").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
                closeOnSelect: false,
            })
            $("#user_select").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
                closeOnSelect: false,
            })


            $("#update_role").validate({
                ignore: 'input[type=hidden]',
                rules:{
                    name:'required',
                    name_ar:'required',
                    "permissions[]":'required',
                },
                messages:{
                    name:'{{__('Role English Name is Required')}}',
                    name_ar:'{{__('Role Arabic Name is Required')}}',
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
