<!doctype html>
<html lang="{{LanguageAttributes::lang_code()}}" dir="{{LanguageAttributes::lang_dir()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/bootstrap.css">
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
  
<style type="text/css">
table{
  /* border: 1px solid; */
  border-collapse: collapse;
  width: 100%;
    margin: 0 auto;
    text-align: center;
}
/* style sheet for "A4" printing */
@media print {
    @page {
        size: A4 portrait;
        margin: 20px auto;
        padding: 20px;
    }

    body {
        padding: 5px;
        font-size: 14px;
        margin: 5% 5% 0 20% !important;
        width:90% !important;
    }

}
.footer {
  position: fixed;
  left: 0;
  bottom: 20;
  width: 100%;
  color: rgb(14, 13, 13);
  text-align: center;
  font-weight: bold; 
}
 </style>   



    <title>{{__('Colors Report')}}</title>
</head>
<body>

    <div id="refresh" align="center">
    <h1>{{__('Colors Report')}}</h1>
    <table border="1" id="datatable-3" class="table table-bordered">
        <thead>
        <tr style="text-align:center">
            {{-- <th>#</th> --}}
            <th>{{__('Color ID')}}</th>
            <th>{{__('Colors Name')}}</th>
            <th>{{__('Colors Category')}}</th>
                  {{-- @canany(['update-customer','delete-customer']) --}}
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
        @foreach($Colors['colors_stages'] as $key=> $Color)
        
            <tr style="text-align:center">
                <td>{{$Color->colorcode}}</td>
                <td>{{$Color->colorname}}</td>
                <td>{{$Color->categorycolors['CategoryCol_name']}}</td>
                {{-- @canany(['update-customer','delete-customer']) --}}
                            <td>{{$Color->user->username}}</td>
                            <td>{{$Color->created_at}}</td>
                        {{-- @endcan --}}
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>

    <div class="footer">
        <p>{{__('Username')}} :  {{auth()->user()->username}} - {{__('PrintTime')}} : {{Now()}}</p>
      </div>
</body>
</html>