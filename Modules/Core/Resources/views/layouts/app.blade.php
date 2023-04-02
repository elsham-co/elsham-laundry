<!DOCTYPE html>
<html lang="{{LanguageAttributes::lang_code()}}" dir="{{LanguageAttributes::lang_dir()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap-'.LanguageAttributes::lang_dir().'.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-core.css')}}">
    <link rel="stylesheet" href="{{asset('css/'.LanguageAttributes::lang_dir().'-vendor.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fancy-apps.css')}}">
    @stack('css')
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('images/small-logo.png')}}"  type = "image/x-icon" />

</head>
<body onload="document.refresh();" class="theme-light preload-active aside-active aside-mobile-minimized aside-desktop-maximized" id="fullscreen">
    <!-- BEGIN Preload -->

    <div class="preload">
        <div class="preload-dialog">
            <!-- BEGIN Spinner -->
            <div class="spinner-border text-primary preload-spinner"></div>
            <!-- END Spinner -->
        </div>
    </div>
    <!-- END Preload -->
    <!-- BEGIN Page Holder -->
    <div class="holder">
        <!-- BEGIN Aside -->
    @include('core::layouts.sideMenu')
    <!-- END Aside -->
        <!-- BEGIN Page Wrapper -->
        <div class="wrapper">
            <!-- BEGIN Header -->
            @include('core::layouts.header')
            <!-- END Header -->

            <!-- BEGIN Page Content -->
            <div class="content">
                @include('core::layouts.scroll')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- END Page Content -->

            <!-- BEGIN Footer -->
            @include('core::layouts.footer')
            <!-- END Footer -->

        </div>
        <!-- END Page Wrapper -->
    </div>
    <!-- END Page Holder -->

    <script type="text/javascript" src="{{asset('js/mandatory.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/core.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vendor.js')}}"></script>
    {{-- <script type="text/javascript" src="{{asset('js/home.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/datatable.js')}}"></script>
    <script src="{{asset('js/jquery-validation.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/fancy-apps.js')}}"></script>
    <script src="{{asset('js/fancy-apps.js')}}"></script>


    @include('core::layouts.notify')


    <script>

        $(document).ready(function () {
            $(document).on('click','.pagination a',function (e) {
                e.preventDefault()
                var url=$(this).attr("href");
                ajax(url)

            })
            $(document).on('keyup','.searchTerm',function (e) {
                e.preventDefault()
                var url= $(this).data('href')
                ajax(url)

            })
        })

        function ajax(url)
        {

            var append=url.indexOf("?")==-1?"?":"&";
            var finalURL=url+append+$(".searchTerm").serialize();

            //set to current url
            history.pushState({},null, finalURL);
            window.onpopstate = function(event) {
                if(event && event.state) {
                    location.reload()
                }
            }
            $.get(finalURL,function(data){

                $(".data").html(data);
            });


        }
        $('input[type=number]').on('change',function (e) {
            if(e.keyCode === 189){
                $(this).val('')
                swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{__("you can't enter negative value")}}",
                    showConfirmButton: false,
                    timer: 2000
                })

            }

            var min = $(this).attr('min')
            if(parseInt($(this).val()) < parseInt(min)){
                $(this).val(min)
                swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "{{__("you can't enter less value than that exists")}}",
                    showConfirmButton: false,
                    timer: 2000
                })

            }

        })


    </script>
    @stack('js')
</body>
</html>
