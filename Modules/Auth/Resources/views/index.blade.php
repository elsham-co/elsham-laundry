{{-- <!DOCTYPE html>
<html lang="{{LanguageAttributes::lang_code()}}" dir="{{LanguageAttributes::lang_dir()}}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-core.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-vendor.css')}}">
    <title>{{__('Login')}}</title>
    <link rel="icon" href="{{asset('images/small-logo.png')}}"  type = "image/x-icon" />
</head>

<body class="theme-light preload-active" id="fullscreen" style="background-image: url('../images/cover.jpg'); background-size: cover;">
<!-- BEGIN Page Holder -->
<div class="holder" style="width: 95% !important;">
    <!-- BEGIN Page Wrapper -->
    <div class="wrapper">
        <!-- BEGIN Page Content -->
        <div class="content" >
            <div class="container-fluid" >
                <div class="row no-gutters align-items-center justify-content-center h-100">
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-3">


                        <!-- BEGIN Portlet -->
                        <div class="portlet">

                            <div class="portlet-body">
                                <div class="text-center mb-5 mr-4">

                                    <img src="{{asset('/images/logo.png')}}" alt="">

                                </div>
                                <!-- BEGIN Form -->
                                <form id="login-form" action="{{route('do.login')}}" method="POST">
                                    @csrf
                                    <!-- BEGIN Form Group -->
                                        <div class="row ml-2">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="float-label float-label-lg">
                                                        <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Please insert your email">
                                                        <label for="email">{{__('Email')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="float-label float-label-lg">
                                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Please insert your password">
                                                        <label for="password">{{__('Password')}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    <div class="d-flex align-items-center justify-content-between mb-3 ml-5 mr-5">
                                        <div class="form-group mt-5">
                                            <div class="custom-control custom-control-lg custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember_me">
                                                <label class="custom-control-label" for="remember">{{__('Remember me')}}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-label-primary btn-lg btn-widest mt-4">{{__('Login')}}</button>

                                    </div>

                                </form>
                                <!-- END Form -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </div>
    <!-- END Page Wrapper -->
</div>
<!-- END Page Holder -->


<script type="text/javascript" src="{{asset('js/mandatory.js')}}"></script>
<script type="text/javascript" src="{{asset('js/core.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>
@include('core::layouts.notify')
</body>

</html>
 --}}

 <!DOCTYPE html>
<html lang="{{LanguageAttributes::lang_code()}}" dir="{{LanguageAttributes::lang_dir()}}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-core.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-vendor.css')}}">
    <title>{{__('Login')}}</title>
    <link rel="icon" href="{{asset('images/small-logo.png')}}"  type = "image/x-icon" />
</head>

<body class="theme-light preload-active" id="fullscreen" style="background-image: url('../images/cover.jpg'); background-size: cover;">
<!-- BEGIN Page Holder -->
<div class="holder" style="width: 95% !important;">
    <!-- BEGIN Page Wrapper -->
    <div class="wrapper">
        <!-- BEGIN Page Content -->
        <div class="content" >
            <div class="container-fluid" >
                <div class="row no-gutters align-items-center justify-content-center h-100">
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-3">


                        <!-- BEGIN Portlet -->
                        <div class="portlet">

                            <div class="portlet-body">
                                <div class="text-center mb-5 mr-4">

                                    <img src="{{asset('/images/logo.png')}}" alt="">

                                </div>
                                <!-- BEGIN Form -->
                                <form id="login-form" action="{{route('do.login')}}" method="POST">
                                    @csrf
                                    <!-- BEGIN Form Group -->
                                        <div class="row ml-2 align-items-center justify-content-center">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="float-label float-label-lg">
                                                        <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Please insert your email">
                                                        <label for="email">{{__('Email')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <div class="float-label float-label-lg">
                                                        <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Please insert your password">
                                                        <label for="password">{{__('Password')}}</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    <div class="d-flex align-items-center justify-content-between mb-3 ml-5 mr-5">
                                        <div class="form-group mt-5">
                                            <div class="custom-control custom-control-lg custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember_me">
                                                <label class="custom-control-label" for="remember">{{__('Remember me')}}</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-label-primary btn-lg btn-widest mt-4">{{__('Login')}}</button>

                                    </div>

                                </form>
                                <!-- END Form -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </div>
    <!-- END Page Wrapper -->
</div>
<!-- END Page Holder -->


<script type="text/javascript" src="{{asset('js/mandatory.js')}}"></script>
<script type="text/javascript" src="{{asset('js/core.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>
@include('core::layouts.notify')
</body>

</html>

