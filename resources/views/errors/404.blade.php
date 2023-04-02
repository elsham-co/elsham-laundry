<!DOCTYPE html>
<html lang="{{LanguageAttributes::lang_code()}}" dir="{{LanguageAttributes::lang_dir()}}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-core.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-vendor.css')}}">
    <title>{{__('404')}}</title>
    <link rel="icon" href="{{asset('images/small-logo.png')}}"  type = "image/x-icon" />

</head>

<body class="theme-light preload-active" id="fullscreen">

<!-- BEGIN Page Holder -->
<div class="holder">
    <!-- BEGIN Page Wrapper -->
    <div class="wrapper">
        <!-- BEGIN Page Content -->
        <div class="content ">
            <div class="container-fluid">
                <div class="row no-gutters align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-6 col-xl-4 text-center">
                        <h1 class="widget20">{{__('404')}}</h1>
                        <h2 class="mb-3">{{__('Page Not Found!')}}</h2>
{{--                        <p class="mb-4">Sorry we can't seem to find the page you're looking for. There may be amisspelling in the URL entered, or the page you are looking for may no longer exist.</p>--}}
                        <a href="{{route('dashboard')}}" class="btn btn-label-primary btn-lg btn-widest">{{__('Back to home')}}</a>
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
</body>

</html>
