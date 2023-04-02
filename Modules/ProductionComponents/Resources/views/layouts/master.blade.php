<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
       
        <title>Module ProductionComponents</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/productioncomponents.css') }}"> 

    <link href="{{asset('css/productioncomponents.css')}}" rel="stylesheet">
       <link rel="stylesheet" href="{{ mix('css/productioncomponents.css') }}">
--}}
    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/productioncomponents.js') }}"></script> --}}
      
    </body>
</html>
