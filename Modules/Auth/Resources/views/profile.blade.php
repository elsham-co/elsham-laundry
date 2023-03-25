@extends('core::layouts.app')
@section('title')
    {{__('Profile')}}
@endsection
@section('content')

    <div class="mt-5 mb-5 ml-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Profile')}}</div>
                <form action="{{route('update.profile')}}" id="update_profile" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="full_name">{{__('First Name')}}</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$user['full_name']}}" name="full_name" id="full_name" >
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <label for="username">{{__('Last Name')}}</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$user['last_name']}}" name="last_name" id="username" >
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <label for="username">{{__('Username')}}</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$user['username']}}" name="username" id="username" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="password">{{__('Old Password')}}</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="old_password"  id="old_password" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="password">{{__('New Password')}}</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"  id="password" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg" form="update_profile">{{__('Update')}}</button>
                        <a href="{{route('dashboard')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#update_profile").validate({
                rules: {
                    full_name: "required",
                    // last_name: "required",
                    username: "required",
                    old_password: "required",
                },
                messages: {
                    first_name: "{{__('First name is required')}}",
                    // last_name: "{{__('Last name is required')}}",
                    username: "{{__('Username is required')}}",
                    old_password: "{{__('Old Password is required if password have content')}}",

                }
            });
        })
    </script>

@endpush
