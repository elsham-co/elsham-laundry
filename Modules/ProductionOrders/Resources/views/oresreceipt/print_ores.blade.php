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
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
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
        size: A5 Landscape;
        margin: 0.5cm auto;
        padding: 10px;
    }

    @page :left {
margin: 0.5cm;
}

@page :right {
margin: 0.5cm;
}

    body {
        /* padding: 5px;
        font-size: 14px; */
        /* margin: 5% 5% 0 20% !important; */
        /* width:90% !important; */
        /* font: 18pt Georgia, "Times New Roman", Times, serif; */
        font: 16pt Georgia, "Times New Roman", Times, serif;
        color: rgb(14, 13, 13);
/* line-height: 1.3; */
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
  font-size: 12px;
}
 </style>   



    {{-- <title>{{__('Fabrics Report')}}</title> --}}
</head>
<body>
    {{-- <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                        <label for="samplecode">{{__('Receipt Code')}} :</label>
                                        <input type="text" class="form-control form-control-lg" value="{{$OresPrint->orescode}}"  id="samplecode" name="samplecode">
                            </div>
                        </div>
                  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ores_recipt_date">{{__('Receipt Date')}} :</label>
                                    <input type="text" class="form-control form-control-lg" value="{{date('d-m-Y', strtotime($OresPrint->ores_recipt_date))}}"  id="ores_recipt_date" name="ores_recipt_date">
                        </div>
                    </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="data">{{__('Customer Name')}} :</label>
                                        <input type="text" class="form-control form-control-lg" value="{{$OresPrint->data}}"  id="data" name="data">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="model_no">{{__('Model No')}} :</label>
                                    <input type="text" class="form-control form-control-lg" value="{{$OresPrint->model_no}}"  id="model_no" name="model_no">
                        </div>
                    </div>
                       

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                                <input type="text" class="form-control form-control-lg" value="{{$OresPrint->fabric}}"  id="fabrics_code" name="fabrics_code">
                    </div>
                </div>

                <div class="col-md-6">
                        <div class="form-group">
                            <label for="material_receiver">{{__('Materials Receiver')}} :</label>
                                <input type="text" class="form-control form-control-lg" value="{{$OresPrint->materials_receiver}}"  id="material_receiver" name="material_receiver">
                    </div>
                </div>


                        </div>
                    </div>
                
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet--> --}}


    <div class="card" id="print_page">
        {{-- <div class="" style="background-color: #5c2283; border: none" >
            <div class="col-md-12">
                <div class="row" style="padding-top: 40px; display: flex; justify-content: space-between; align-items: center">
                    <div class="col-md-5  text-center">
                        <img src="{{url('images/newLogo.png')}}"  alt="" style="width: 200px; height: 200px;">
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5 " style="margin: 0; padding: 0;">
                        <div style="background-color: #fff; padding: 30px; left: 0; border-radius: 7px">
                            <h1 class="text-center" style="font-weight: 700">{{__('Invoice')}}</h1>
                        </div>

                    </div>
                </div> --}}
                <div class="row mt-5">

<table>
  
    <tr>
        <td>
                    <div class="col-md-3 text-center">
                        <h4 style="font-weight: 700; height:2rem;">{{__('Receipt Code')}} :</h4>
                    </div> 
            </td>
          <td>
              {{$OresPrint->orescode}}
           </td>
<td>
    <div class="col-md-6 text-center">
        <h4 style="font-weight: 700; height:2rem;">{{__('Receipt Date')}} :</h4>
     </div>
</td>
<td>
    {{date('d-m-Y', strtotime($OresPrint->ores_recipt_date))}}
</td>
     </tr>
     <tr style="height:2rem;">
        <td>
            <div class="col-md-3 text-center">
                <h4 style="font-weight: 700;height:2rem;">{{__('Customer Name')}} :</h4>
            </div>
        </td>
        <td>
            {{$OresPrint->data}}
        </td>
        <td>
            <div class="col-md-3 text-center">
                <h4 style="font-weight: 700;">{{__('Model No')}} :</h4>
            </div>
           </td>
           <td>
            {{$OresPrint->model_no}}
        </td>
        </tr>
    <tr style="height:2rem;border-width: thin;">
               <td>
                <div class="col-md-3 text-center">
                    <h4 style="font-weight: 700;">{{__('Fabrics Name')}} :</h4>
                </div>
               </td>
               <td>
                {{$OresPrint->fabric}}
               </td>
               <td>
                <div class="col-md-3 text-center">
                    <h4 style="font-weight: 700;">{{__('Material Number')}} :</h4>
                </div>
            </td>
                <td>
                    {{$OresPrint->material_number}}
                </td>
                <td>
                    <div class="col-md-3 text-center">
                        <h4 style="font-weight: 700;">{{__('Material Weight')}} :</h4>
                    </div>
                </td>
                    <td>
                        {{$OresPrint->material_weight}}
                    </td>
             </tr>   
             {{-- <tr>
           
                   
             </tr>        --}}
             <tr style="height:2rem;">
            <td >
                المستلم:
            </td>  
            <td>
                {{auth()->user()->username}}
                </td>  
                <td>
                    الورديه:
                </td>
                <td>
                الصباحيه
            </td>
            </tr>  
            </table>
        </div>
            </div>
        </div>


    </div>

    <div class="footer">
        <p>{{__('Username')}} :  {{auth()->user()->username}} - {{__('PrintTime')}} : {{Now()}}</p>
      </div>
</body>
</html>