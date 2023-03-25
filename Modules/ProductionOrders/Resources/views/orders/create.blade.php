@extends('core::layouts.app')

@section('title')
    {{__('create production orders')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Samples_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}"> --}}
    
@endpush
@section('content')
<header class="head_name" >
    <h3 class="fa fa-vial" >
        {{__('create production orders')}}
   </h3>
</header>
<br>
<div class="portlet">
    <div class="portlet-body d-flex align-items-center justify-content-center">
        <form action="{{route('orders.store')}}" method="POST" id="create_Orders" name="create_Orders" enctype="multipart/form-data" autocomplete="off">
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
                           <hr>
                           <optgroup >
                            <option  value="">
                            <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                               {{__('Add New Customer')}}</a>
                            </option>
                            </optgroup>
                           <hr>
                           @foreach($CustomerName1 as $CustomerName)
                           <option id="" value="{{$CustomerName->customers_code}}"> {{ $CustomerName->customers_code." - ".$CustomerName->customers_name}} </option>
                         @endforeach
                       </select>
                  <button type="button" id="bill_icon" hidden>open modal</button>
               

              <label for="multiSelect">{{__('Customer Name')}} :</label>
             </div>
            </div>
          </div>

              <!-- Options -->
              <div class="col-md-4" id="fabricsselect">
                <div class="form-group">
            <div class="float-label float-label-lg">
                <select  class="form-select select2 area" id="fabSelect" name="fabrics_code" th:field="*{brokerCategoryCodes}">
               <option value="" disabled selected>{{__('-- Select Fabric --')}}</option> 
               <hr>
               <optgroup >
                <option  value="">
                <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                   {{__('create new Fabrics')}}</a>
                </option>
                </optgroup>
               <hr>
                       @foreach($FabricName as $singleName)
                       <option id="" value="{{$singleName->fabric_code}}"> {{ $singleName->fabric_code." - ".$singleName->fabricName}} </option>
                     @endforeach
                   </select>
              <button type="button" id="fabric_icon" hidden>open modal</button>
           
          <label for="fabSelect">{{__('Fabrics Name')}} :</label>
         </div>
        </div>
        </div>
        
                  <!-- Options -->
                  <div class="col-md-2">
                    <div class="form-group">
                <div class="float-label float-label-lg">
                    <select  class="form-select select2 area" id="thread_code" name="thread_code" th:field="*{brokerCategoryCodes}">
                   <option value="" disabled selected>{{__('-- Select Thread --')}}</option> 
                   <hr>
                   <optgroup >
                    <option  value="">
                    <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                       {{__('Add New Thread')}}</a>
                    </option>
                    </optgroup>
                   <hr>
                           @foreach($ThreadName as $singleName)
                           <option id="" value="{{$singleName->thread_code}}"> {{ $singleName->thread_code." - ".$singleName->thread_name}} </option>
                         @endforeach
                       </select>
                  <button type="button" id="thread_icon" hidden>open modal</button>
               
              <label for="thread_code">{{__('Thread Name')}} :</label>
             </div>
            </div>
            </div>

        <div class="col-md-2">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="number" class="form-control form-control-lg"   id="nopieces" name="nopieces">
                <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
            </div>
        </div>
        </div>

</div>
</div>
           <div class="text-center mt-5">
               <button class="btn btn-success btn-lg">{{__('Create')}}</button>
               <a href="{{route('SamplesOrder.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
            </div>
         <!-- End Form Group -->
    </form>
    @include('samples::SamplesOrder.create_modal')
    {{-- @include('samples::SamplesOrder.create_fabricmodal') --}}
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
        $("#create_SamplesOrder").attr("autocomplete", "off");
        $("#create_customer").attr("autocomplete", "off");
        $("#create_fabric").attr("autocomplete", "off");

    $('#multiSelect').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
theme: "bootstrap-5",
tags: true,
});
$('#fabSelect').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
theme: "bootstrap-5",
tags: true,
});
$('#colSelect').select2({
placeholder: "{{__('-- Select Colors --')}}",
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
theme: "bootstrap-5",
tags: true,
});
$('#fasSelect').select2({
placeholder: "{{__('-- Select Fashions --')}}",
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
theme: "bootstrap-5",
tags: true,
});

    $("#multiSelect").validate().settings.ignore=[];
    $("#fabSelect").validate().settings.ignore=[];
    $("#colSelect").validate().settings.ignore=[];
    $("#fasSelect").validate().settings.ignore=[];
    
    //    $('#bill_icon').hide();  // hide button

        $("#create_SamplesOrder").validate({
            ignore: 'input[type=hidden]',
            rules:{
                samplecode:'required',
                customer_code:'required',
                fabrics_code:'required',
                nopieces:'required',
                samplesnotes: {maxlength:127}
            },
            messages:{
                samplecode:'{{__('SamplesOrder ID is Required Field...Please SamplesOrder ID')}}',
                customer_code:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
                fabrics_code:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                nopieces:'{{__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces')}}',
                samplesnotes:{
                    maxlength: '{{__('Sorry...it is allowed to enter 127 characters in Samples Order Notes')}}'
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
$('select[name=customer_code]').change(function() {
if ($(this).val() == '')
{
document.getElementById("bill_icon").focus();
document.getElementById("bill_icon").click();
$('#multiSelect').val(''); 
$('#multiSelect').change();
// 
}
});
// =========================================================================================================
$("#bill_icon").click(function(){
// $('student_id').val(' ');

$('#create_customer').trigger("reset");
$('#customers_name').val(''); 
$('#phone1').val('');
$('#modalHeading').html(" {{__('Add New Customer')}}");
$('#customers_code').prop('readonly', true);
// $('#custselect').load(location.href +  ' #custselect');
//     var validator = $( "#create_customer" ).validate();
// validator.resetForm();
$('#ajaxModal').modal('show');

});    
// =================================================================================================
// =================================================================================================
// $("#saveBtn").click(function(e){

// e.preventDefault();
            // var customers_code = $('#customers_code').val();
            // var customers_name = $('#customers_name').val();
            // var phone1 =  $('#phone1').val();

            // ajax request send
        //         $.ajax({
        //             url: '/store_customeroutmodule/'+customers_code+'/'+customers_name+'/'+phone1,
        // method: 'get',

        // success: function(result){
         // show alert  
        //  $('.alert-success').removeClass('d-none')
// //append select2  
// var option = new Option(customers_code +' - '+ customers_name, "id");
// option.selected = true;

// $("#multiSelect").append(option);
// $("#multiSelect").trigger("change");

//  // clear fields
        //  $('#customers_name').val('')
        //  $('#phone1').val('') 
        // $('#ajaxModal').find('input').val('');
        // }
       
        //         })

        
   
        // });

    //  }
//  });

// =========================================================================================================
$('select[name=fabrics_code]').change(function() {
if ($(this).val() == '')
{
document.getElementById("fabric_icon").focus();
document.getElementById("fabric_icon").click();
$('#fabSelect').val(''); 
$('#fabSelect').change();
// 
}
});
// =========================================================================================================
$("#fabric_icon").click(function(){ 
$('#create_fabric').trigger('create');
$('#fabricName').val(''); 
$('#fabricHeading').html(" {{__('create new Fabrics')}}");
$('#fabric_code').prop('readonly', true);
// $('#custselect').load(location.href +  ' #custselect');
$("#error_fabricName").hide();
        $("#error_categoryFabric").hide();
$('#fabricModal').modal('show');

});    
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
// ===================================================================================


});

</script>
@endpush