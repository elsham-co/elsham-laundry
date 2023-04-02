@extends('core::layouts.app')

@section('title')
    {{__('Add New Ores Receipt')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Samples_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}"> --}}
    <style>
 .portlet form{
    width: 75%;
  }
        </style>
@endpush
@section('content')
<header class="head_name" >
    <h3 class="fa fa-balance-scale-right" >
        {{__('Add New Ores Receipt')}}
   </h3>
</header>
<br>
<div class="portlet">
    <div class="portlet-body d-flex align-items-center justify-content-center">
        <form action="{{route('oresreceipt.store')}}" method="POST" id="create_oresreceipt" name="create_oresreceipt" enctype="multipart/form-data" autocomplete="off">
            @csrf
    
        <!-- BEGIN Form Group -->
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-4" id="custselect">
                    <div class="form-group">
                <div class="float-label float-label-lg">
                    <select  class="form-select select2 area" id="multiSelect" name="customer_code" th:field="*{brokerCategoryCodes}">
                   <option value="" disabled selected>{{__('-- Select Customer --')}}</option> 
                           @foreach($CustomerName1 as $CustomerName)
                           <option id="" value="{{$CustomerName->customers_code}}"> {{ $CustomerName->customers_code." - ".$CustomerName->customers_name}} </option>
                         @endforeach
                       </select>
              <label for="multiSelect">{{__('Customer Name')}} :</label>
             </div>
            </div>
          </div>

              <!-- Options -->
              <div class="col-md-4" id="fabricsselect">
                <div class="form-group">
            <div class="float-label float-label-lg">
                <select  class="form-select select2 area" id="fabSelect" name="fabrics_code" th:field="*{brokerCategoryCodes}">
               <option value="" disabled selected>{{__('-- Select Fabric --')}}</option> hr>
                       @foreach($FabricName as $singleName)
                       <option id="" value="{{$singleName->fabric_code}}"> {{ $singleName->fabric_code." - ".$singleName->fabricName}} </option>
                     @endforeach
                   </select>
           
          <label for="fabSelect">{{__('Fabrics Name')}} :</label>
         </div>
        </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="text" class="form-control form-control-lg"   id="model_no" name="model_no">
                <label for="model_no">{{__('Model No')}} :</label>
            </div>
        </div>
        </div>        

        <div class="col-md-4">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="number" min="0" class="form-control form-control-lg"   id="material_number" name="material_number">
                <label for="material_number">{{__('Material Number')}} :</label>
            </div>
        </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="number" min="0" class="form-control form-control-lg"   id="material_weight" name="material_weight">
                <label for="material_weight">{{__('Material Weight')}} :</label>
            </div>
        </div>
        </div>
        
        <!-- <div class="col-md-4">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="text" class="form-control form-control-lg"   id="materials_receiver" name="materials_receiver">
                <label for="materials_receiver">{{__('Materials Receiver')}} :</label>
            </div>
        </div>
        </div> -->

        <div class="form-group" >
            <div class="float-label float-label-lg">
            <textarea rows="3" cols="30" id="materials_notes" class="form-control form-control-lg" name="materials_notes" placeholder="{{__('Please... Enter The Samples Order Notes')}}"></textarea>
            <label for="materials_notes">{{__('Materials Notes')}} :</label>
        </div>
    </div>

</div>
</div>
           <div class="text-center mt-5">
               <button class="btn btn-success btn-lg">{{__('Create')}}</button>
               <a href="{{route('oresreceipt.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
            </div>
         <!-- End Form Group -->
    </form>
    {{-- @include('samples::SamplesOrder.create_modal') --}}
    <div class="col"></div>
</div> <!--close portlet_body-->

</div>  <!--close portlet-->

@endsection

@push('js')
{{-- <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script> --}}
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#samplecode').prop('readonly', true); //  
        $("#create_oresreceipt").attr("autocomplete", "off");

    $('#multiSelect').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
});
$('#fabSelect').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
});

// Find all existing Select2 instances
$('.select2-hidden-accessible')
    // Attach event handler with some delay, waiting for the search field to be set up
    .on('select2:open', event => setTimeout(
        // Trigger focus using DOM API
        () => $(event.target).data('select2').dropdown.$search.get(0).focus(),
        10));

    $("#multiSelect").validate().settings.ignore=[];
    $("#fabSelect").validate().settings.ignore=[];
    
    $(".select2").on('change', function() {
        $(this).trigger('blur');
      });

        $("#create_oresreceipt").validate({
            ignore: 'input[type=hidden], .select2-input, .select2-focusser',
            rules:{
                customer_code:'required',
                fabrics_code:'required',
                material_number: {required:true ,maxlength:5},
                material_weight: {maxlength:5},
                materials_receiver:'required',
                materials_notes: {maxlength:127}
            },
            messages:{
                customer_code:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
                fabrics_code:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                material_number: {
                    required:'{{__('Material Number is Required Field...Please Add Material Number')}}',
                    maxlength: '{{__('Sorry...it is allowed to enter 5 digtes in Material Number')}}'
                },
                material_weight: {
                    
                    maxlength: '{{__('Sorry...it is allowed to enter 5 digtes in Material Weight')}}'
                },
                materials_receiver:'{{__('Materials Receiver is Required Field...Please Add Materials Receiver')}}',
                materials_notes:{
                    maxlength: '{{__('Sorry...it is allowed to enter 127 characters in Materials Notes')}}'
                }
                

                
            },
            errorElement: "div",
  errorPlacement: function ( error, element ) {
    if (element.hasClass('select2') && element.next('.select2-container').length) {
          error.addClass( "invalid-feedback" );
          error.insertAfter(element.next('.select2-container'));
      }else{
    error.addClass( "invalid-feedback" );
    error.insertAfter( element );
      }
},
highlight: function(element) {
$(element).removeClass('is-valid').addClass('is-invalid');
},
unhighlight: function(element) {
$(element).removeClass('is-invalid').addClass('is-valid');
}
        })
// =========================================================================================================
// =========================================================================================================
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
// ===================================================================================


});

</script>
@endpush