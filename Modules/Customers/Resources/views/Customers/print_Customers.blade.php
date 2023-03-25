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



    <title>{{__('Customers Report')}}</title>
</head>
<body>

    <div id="refresh" align="center">
    <h1>{{__('Colors Report')}}</h1>
    <table border="1" id="datatable-3" class="table table-bordered">
        <thead>
        <tr style="text-align:center">
            {{-- <th>#</th> --}}
            <th>{{__('Customer ID')}}</th>
        <th>{{__('Customer Name')}}</th>
        <th>{{__('Phone Number 1')}}</th>
        {{-- <th>{{__('Phone Number 2')}}</th> --}}
        <th>{{__('Email')}}</th>
              {{-- @canany(['update-customer','delete-customer']) --}}
              <th>{{__('Created_by')}}</th>
              <th>{{__('Created_at')}}</th>
              {{-- @endcan --}}
                  {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
            @foreach($customers as $key=> $customer)
            <tr style="text-align:center">
                <td>{{$customer->customers_code}}</td>
                <td>{{$customer->customers_name}}</td>
                <td>{{$customer->phone1}}</td>
                {{-- <td>{{$customer->phone2}}</td> --}}
                <td>{{$customer->email}}</td>
                {{-- @can('view-userCreater') --}}
                <td>{{$customer->user->username}}</td>
        
                <td>{{$customer->created_at}}</td>
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