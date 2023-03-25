@extends('core::layouts.app')

@section('title')
    {{__('View Samples phases')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap-5-theme.rtl.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/switchery.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('View Samples phases')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
                <form action="" method="POST" id="update_Samples" name="update_Samples" enctype="multipart/form-data" autocomplete="off">
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->samplecode}}"  id="samplecode" name="samplecode">
                                    <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                                </div>
                            </div>
                        </div>
                  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="float-label float-label-lg">
                                            <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->data}}"  id="customer_code" name="customer_code">
                                        <label for="customer_code">{{__('Customer Name')}} :</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->fabric}}"  id="fabrics_code" name="fabrics_code">
                                    <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                    <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->Sampleorder->nopieces}}"  id="nopieces" name="nopieces">
                                <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
                            </div>
                        </div>
                    </div> 


        <div class="col-md-2">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->classification}}"  id="classification" name="classification">
                <label for="classification">{{__('Classification')}} :</label>
            </div>
        </div>
    </div>



        <!-- Options -->
        {{-- <div class="col-md-4">
            <div class="form-group">
          <div class="float-label float-label-lg">
                @if($Sample_bank->operation_type == 'dyeing')
                <input type="text" value={{__('Dyeing')}} class="form-control form-control-lg" id="op_type" name="op_type">
                @elseif($Sample_bank->operation_type == 'dyeing+fashion')
                <input type="text" class="form-control form-control" value="{{__('Dyeing + Fashion')}}"  id="op_type" name="op_type">
                @elseif($Sample_bank->operation_type == 'laundry')
                <input type="text" class="form-control form-control" value="{{__('laundry')}}"  id="op_type" name="op_type">
                @elseif($Sample_bank->operation_type == 'laundry+fashion')
                <input type="text" class="form-control form-control" value="{{__('Laundry + Fashion')}}"  id="op_type" name="op_type">
             @endif
                <label for="operation_type">{{__('Operation Type')}} :</label>
      </div>
     </div> 
     </div>  --}}

     <div class="col-md-4">
        <div class="form-group">
            <div class="float-label float-label-lg">
                <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->technical_description}}"  id="technical_description" name="technical_description">
            <label for="technical_description">{{__('Technical Description')}} :</label>
        </div>
    </div>
    </div> 
                            {{-- <div class="form-group" >
                                <div class="float-label float-label-lg">
                                <textarea rows="3" cols="30" id="samplesnotes" class="form-control form-control-lg" name="samplesnotes" placeholder="{{__('Please... Enter The Samples Order Notes')}}"></textarea>
                                <label for="samplesnotes">{{__('Samples Order Notes')}} :</label>
                            </div>
                        </div> --}}
                
                        
                       
    
{{-- ====================================================================================================== --}}
<div class="card"> {{--start class card--}}
    <div class="card-header" style="font-size: 16px;font-weight: bold;">
        {{__('Sample Phases')}}  
    </div>
    <div class="card-body">  {{--start class card-body --}}

         <table class="table" id="products_table">
            <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th>{{__('Phase Name')}}</th>
                    <th>{{__('Phase Note')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($Sample_bank->Sample_info) as $key=> $StageName)
                <tr id="product0"  style="text-align:center">
                    <th scope="row">{{$key+1}}</th>
                   
                    <td>
                           {{$StageName->stage_name}}
                    </td>
                    <td>
                       {{$StageName->stage_notes}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>   


        <br> 
        <br>
       <div class="form-group">
        <div class="col-md-12" style="background: rgb(243, 242, 242);border-radius: 4px; padding: 20px;
        color:rgb(75, 127, 156);">
            <h3 class="fa fa-check" >
                {{__('Sample Info Steps')}}
           </h3>  
            </div>
        <br> 
        <br>
           
       
            {{-- <div class="col-md-2">
                <div class="form-group">
                    <div class="float-label float-label-lg">
                        <input type="text" class="form-control form-control-lg" value="{{$Sample_order->ReceiptDate}}"  id="ReceiptDate" name="ReceiptDate">
                    <label for="ReceiptDate">{{__('Receipt Date')}} :</label>
                </div>
            </div>
            </div> --}}
            @if(!empty($Sample_bank->Sampleorder->ReceiptDate))
            <div class="col-md-4">
                <div class="form-group">
            <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
            <label for="ReceiptDate">{{__('Receipt Date')}} :</label>
            <h3 style="font-weight: bold;font-size: 18px;">
                {{$Sample_bank->Sampleorder->ReceiptDate}}
                <br>
                {{$Sample_bank->user_sampleorder_created}}
           </h3>
        </div>
            </div>
             <br>
           @endif
           @if(!empty($Sample_bank->Sampleorder->updated_at))
           <div class="col-md-4">
            <div class="form-group">
            <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
            <label for="LabReceiptDate">{{__('Last Update')}} :</label>
            <h3 style="font-weight: bold;font-size: 18px;">
                {{$Sample_bank->Sampleorder->updated_at}}
                <br>
                {{$Sample_bank->user_sampleorder_updated}}
           </h3>
            </div>
        </div>
        <br>
        @endif

           @if(!empty($Sample_bank->lab_receiptdate))
           <div class="col-md-4">
            <div class="form-group">
            <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
            <label for="LabReceiptDate">{{__('Lab Receipt Date')}} :</label>
            <h3 style="font-weight: bold;font-size: 18px;">
                {{$Sample_bank->lab_receiptdate}}
                <br>
                {{$Sample_bank->user_sample_created}}
           </h3>
            </div>
        </div>
        <br>
        @endif
        @if(!empty($Sample_bank->sample_date))
           <div class="col-md-4">
            <div class="form-group">
            <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
            <label for="LabReceiptDate">{{__('Sample Date')}} :</label>
            <h3 style="font-weight: bold;font-size: 18px;">
                {{$Sample_bank->sample_date}}
                <br>
                {{$Sample_bank->user_sample_updated}}
           </h3>
            </div>
        </div>
        <br>
        @endif
        @if(!empty($Sample_bank->Sampleorder->fromlab_date))
            <div class="col-md-4">
                <div class="form-group">
                <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
                <label for="LabReceiptDate">{{__('From Lab Date')}} :</label>
                <h3 style="font-weight: bold;font-size: 18px;">
                    {{$Sample_bank->Sampleorder->fromlab_date}}
                    <br>
                    {{$Sample_bank->user_sampleorder_fromlab}}
               </h3>
                </div>
            </div>
            <br>
            @endif
            @if(!empty($Sample_bank->Sampleorder->DeliveryDate))
            <div class="col-md-4">
                <div class="form-group">
                <i class='fa fa-check-circle' style=" color:rgb(9, 180, 38);font-size:26px;"></i>
                <label for="LabReceiptDate">{{__('Delivery Date')}} :</label>
                <h3 style="font-weight: bold;font-size: 18px;">
                    {{$Sample_bank->Sampleorder->DeliveryDate}}
                    <br>
                    {{$Sample_bank->user_sampleorder_delivered}}
               </h3>
                </div>
            </div>
            <br>
            @endif
            {{-- <div class="col-md-2">
                <div class="form-group">
                    <div class="float-label float-label-lg">
                        <input type="text" class="form-control form-control-lg" value="{{$Sample_order->DeliveryDate}}"  id="DeliveryDate" name="DeliveryDate">
                    <label for="DeliveryDate">{{__('Delivery Date')}} :</label>
                </div>
            </div>
            </div> --}}
       
            </div>


    </div> {{--end class card-body --}}
 </div> {{--end class card--}}

 


    </div>
</div>
                <div class="text-center mt-5">
                    {{-- <button class="btn btn-success btn-lg">{{__('Update')}}</button> --}}
                    <a href="{{route('SampleBank.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
     </form>
            <div class="col"></div>
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet-->

        @endsection

{{-- =============================================================================================================== --}}
        @push('js')
        <script type="text/javascript" src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
       <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        {{-- <script src="{{asset('js/switchery.js')}}"></script>
        <script src="{{asset('js/uppy.min.js')}}"></script> --}}
        
        <script>
            $(document).ready(function () {

                $('#samplecode').prop('readonly', true); //  
                $("#customer_code ").prop('readonly', true);
                $("#fabrics_code").prop('readonly', true);
                $("#nopieces").prop('readonly', true);
                $("#op_type").prop('readonly', true);
                $("#classification").prop('readonly', true);
                $("#technical_description").prop('readonly', true);
                

                $("#edit_SampleBank").attr("autocomplete", "off");
// =================================================================================================
// =================================================================================================
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}

// -*----------------------------------------------------------------------------
$(":input").keyup(function(){
    var inp = this;
    var ink = this;
    var int = this;
  setTimeout(function() {
    inp.value = inp.value.replace(/آ|أ|إ/g, 'ا');  //   // replace (أ-آ-إ) with (ا).
    ink.value = inp.value.replace(/ة/g, 'ه'); //    // Trying to replace (ة) with (ه).
    int.value = inp.value.replace(/ى/g, 'ي'); //    // Trying to replace (ى) with (ي).
  }, 0);
});
// =============================================================================
// stop paste in input text (fabricName)
$(":input").on("paste", function (e) {
    e.preventDefault();
});
// ==================================================================================
});


    </script>
@endpush