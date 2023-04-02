@extends('core::layouts.app')

@section('title')
    {{__('Create Samples Order')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{asset('css/Samples_create.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}"> --}}
    <style>
    .head_name{
    padding: 20px;
    border-radius: 4px;
    background:  rgb(243, 242, 242);
      font-size: 10px;
      font-weight: bold;
      color:rgb(75, 127, 156);
  }
  .portlet{
    width: 100%;
    /* height: 100%; */
    font-size: 16px;
    font-weight: bold;
  
  }


  /*Background color*/
  .portlet-body{
    width: 100%;
    
    background: #ecf0f5;
  
  }
  .portlet form{
    width: 65%;
    padding: 30px 30px 20px;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    position: relative;
  }
  .form-group{
    width: 100%;
    margin: 10px 0;
    position: relative;
    top: -25px;
    justify-content:center;
  }
  .form-group label{
    flex-basis: 28%;
    font-size: 16px;
    font-weight: bold;

  }
  .form-group input{
    flex-basis: 100%;
    background: transparent;
    border: 1;
    outline: 0;
    padding: 10px 0;
    border-bottom: 1px solid #999;
    color: rgb(12, 12, 12);
    font-size: 16px;
    text-align: center;
    position: relative;
  }

  .form-group textarea {
    text-align: right;
    justify-content:right;
    font-size: 16px;
  
  }
  
      </style>
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('Samples Order Created Successfully')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="" method="POST" id="create_SamplesOrder" name="create_SamplesOrder" enctype="multipart/form-data" autocomplete="off">
                <!-- @csrf -->
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_order->samplecode}}"  id="samplecode" name="samplecode">
                                    <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                                </div>
                            </div>
                        </div>
                  
                        <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_order->data}}"  id="data" name="data">
                                    <label for="data">{{__('Customer Name')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                                <input type="text" class="form-control form-control-lg" value="{{$Sample_order->fabric}}"  id="fabrics_code" name="fabrics_code">
                            <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                                <input type="text" class="form-control form-control-lg" value="{{$Sample_order->nopieces}}"  id="nopieces" name="nopieces">
                            <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
                        </div>
                    </div>
                </div>


                        </div>
                    </div>
    
                <div class="text-center mt-5">
                <a href="{{route('SamplesOrder.create')}}" class="btn btn-success btn-lg">{{__('Create Samples Order')}}</a>
                    <a href="{{route('SamplesOrder.index')}}" class="btn btn-danger btn-lg">{{__('View All Samples Order')}}</a>
                </div>
                
            </form>
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet-->

        @endsection

        @push('js')
        {{-- <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script> --}}
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        <script>
var ctrlKeyDown = false;

            $(document).ready(function () {
                $('#samplecode').prop('readonly', true); //  
                $('#data').prop('readonly', true); //  
                $('#fabrics_code').prop('readonly', true); //  
                $('#nopieces').prop('readonly', true); //  
               /// ===========================================================================================

// window.onbeforeunload = function() {
//         return "Leave this page ?";
//     }

// =========================================================================================================
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);

});

function keydown(e) { 

if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
    // Pressing F5 or Ctrl+R
    e.preventDefault();
} else if ((e.which || e.keyCode) == 17) {
    // Pressing  only Ctrl
    ctrlKeyDown = true;
}
};

function keyup(e){
// Key up Ctrl
if ((e.which || e.keyCode) == 17) 
    ctrlKeyDown = false;
};

    </script>
@endpush