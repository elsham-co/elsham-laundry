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
        margin: 0px auto;
        padding: 0px;
    }

    body {
        /* padding: 75px; */
        font-size: 14px;
        /* margin: 75% 5% 0 40% !important; */
        width:100% !important;
    }

}
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: rgb(14, 13, 13);
  text-align: center;
  font-weight: bold; 
}
 </style>   



    <title>{{__('Threads Report')}}</title>
</head>
<body>

    <div id="refresh" align="center">
    <h1>{{__('Threads Report')}}</h1>
    <table border="1" id="datatable-3" class="table table-bordered">
        <thead>
        <tr style="text-align:center">
            {{-- <th>#</th> --}}
            <th>{{__('Thread_ID')}}</th>
            <th>{{__('Thread_Name')}}</th>
                  {{-- @canany(['update-customer','delete-customer']) --}}
                  <th>{{__('Created_by')}}</th>
                  <th>{{__('Created_at')}}</th>
                  {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
        @foreach($threads['threads'] as $key=> $thread)
        
            <tr style="text-align:center">
                <td>{{$thread->thread_code}}</td>
                <td>{{$thread->thread_name}}</td>
                {{-- @canany(['update-customer','delete-customer']) --}}
                            <td>{{$thread->user->username}}</td>
                            <td>{{$thread->created_at}}</td>
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