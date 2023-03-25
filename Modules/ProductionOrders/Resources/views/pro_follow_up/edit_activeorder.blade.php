@extends('core::layouts.app')

@section('title')
{{__('Update Active Production Order')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fas fa-users" >
        {{__('Update Active Production Order')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('activeorder.update',$allorderdata->id)}}" method="POST" id="update_active_order" name="update_active_order"enctype="multipart/form-data" autocomplete="off">
                @method("PUT")
                @csrf
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                    <input type="text" class="form-control" value="{{$allorderdata->production_order}}"  id="production_order" name="production_order" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)" autocomplete="off">
                                    <label for="production_order">{{__('Production Order')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" autocomplete="off">
                                <div class="float-label float-label-lg">
                                <input type="text" class="form-control" value="{{$allorderdata->number_voucher}}"  id="number_voucher" name="number_voucher" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                                <label for="number_voucher">{{__('Number Voucher')}} :</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
            <div class="form-group">
                <div class="float-label float-label-lg">
                <input type="{{$allorderdata->created_at}}" class="form-control" value="{{$allorderdata->created_at}}" id="11"name="11" readonly  >
                <label for="created_at">{{__('Prodction Date')}}</label>
            </div>
           </div>
          </div>
                     
                <!-- Options -->
               <div class="col-md-6">
                        <div class="form-group">
                    <div class="float-label float-label-lg">
                        <select  class="form-select select2 area" id="multiSelect" name="customer_code" th:field="*{brokerCategoryCodes}" required>
                       <option value="" disabled selected>{{__('-- Select Customer --')}}</option> 

                             @foreach($CustomerName1 as $CustomerName)
                                  <option value="{{$CustomerName->customers_code}}"

                                       @if($CustomerName->customers_code == $allorderdata->customer_id)
                                           selected
                                       @endif
                                  >{{$CustomerName->customers_code." - ".$CustomerName->customers_name}}</option>
                              @endforeach

                           </select>
                  <label for="multiSelect">{{__('Customer Name')}} :</label>
                 </div>
                </div>
              </div>


       <div class="col-md-6">
        <div class="form-group">
    <div class="float-label float-label-lg">
        <select  class="form-select select2 area" id="fabSelect" name="fabrics_code" th:field="*{brokerCategoryCodes}" required>
       <option value="" disabled selected>{{__('-- Select Fabric --')}}</option> 
                   @foreach($FabricName as $singleName)
                                  <option value="{{$singleName->fabric_code}}"

                                       @if($singleName->fabric_code == $allorderdata->fabrics_code)
                                           selected
                                       @endif
                                  >{{$singleName->fabric_code." - ".$singleName->fabricName}}</option>
                              @endforeach

           </select>
   
  <label for="fabSelect">{{__('Fabrics Name')}} :</label>
 </div>
</div>
</div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="{{$allorderdata->total}}" id="total" name="total" onkeypress="return /[0-9]/i.test(event.key)">
                            <label for="total">{{__('Fabrics Pieces')}} :</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="float-label float-label-lg">
                        <input type="text" class="form-control" value="{{$allorderdata->weight}}" id="weight"name="weight" onkeypress="return /[0-9]/i.test(event.key)">
                        <label for="weight">{{__('Weight')}} :</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="float-label float-label-lg">
                    <input type="text" class="form-control" value="{{$allorderdata->totalfashion}}" id="totalfashion"name="totalfashion" onkeypress="return /[0-9]/i.test(event.key)">
                    <label for="totalfashion">{{__('Fashion Count')}} :</label>
                </div>
            </div>
        </div>
 
        <!-- Options -->
 <div class="col-md-6">
    <div class="form-group">
<div class="float-label float-label-lg">
    <select  class="form-select select2 area" id="colSelect" name="colors_code" th:field="*{brokerCategoryCodes}" required>
        <option value="" disabled selected>{{__('-- Select Fabric --')}}</option> 
         @foreach($ColorsName as $singleColor)
                                  <option value="{{$singleColor->colorcode}}"

                                       @if($singleColor->colorcode == $allorderdata->colors_code)
                                           selected
                                       @endif
                                  >{{$singleColor->colorcode." - ".$singleColor->colorname}}</option>
                              @endforeach
       </select>
   <label for="colSelect">{{__('Colors Name')}} :</label>
   </div>
  </div>
  </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                  <a href="{{route('pro_follow_up.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a> 
                </div>
                
            </form>
            
            <div class="col"></div>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#production_order').prop('readonly', true); // 
                $('#created_at').prop('readonly', true); // 
                $("#update_active_order").attr("autocomplete", "off");

                $('#multiSelect').select2({
    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
    dropdownAutoWidth: true,
             });
     $('#fabSelect').select2({
    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
    dropdownAutoWidth: true,

      });
            $('#colSelect').select2({
      placeholder: "{{__('-- Select Colors --')}}",
       dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
       dropdownAutoWidth: true,
       });



$("#multiSelect").validate().settings.ignore=[];
$("#fabSelect").validate().settings.ignore=[];
$("#colSelect").validate().settings.ignore=[];

// Find all existing Select2 instances
$('.select2-hidden-accessible')
// Attach event handler with some delay, waiting for the search field to be set up
.on('select2:open', event => setTimeout(
// Trigger focus using DOM API
() => $(event.target).data('select2').dropdown.$search.get(0).focus(),
10));



$("select").on("select2:close", function (e) {
$(this).valid(); 
});

    $("#update_active_order").validate({
        ignore: 'input[type=hidden]',
        rules:{
            production_order:{required:true,maxlength:20},
            number_voucher:{required:true,maxlength:20},
            customer_code:'required',
            fabrics_code:'required',
            colors_code:'required',
            total:{required:true,maxlength:8},
            weight:{required:true,maxlength:8},
            totalfashion:{number: true,min: 0,max: 99.99}
        },
        messages:{
            production_order:{
                required:'{{__('Number Voucher is Required Field...Please Add Production Order')}}',
                maxlength:'{{__('Sorry...it is allowed to enter 20 characters in Production Order')}}'
            },
            customer_code:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
            number_voucher:{ 
                required:'{{__('Number Voucher is Required Field...Please Add Number Voucher')}}',
                maxlength: '{{__('Sorry...it is allowed to enter 20 characters in Number Voucher')}}'
            },
            fabrics_code:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
            colors_code:{
            required:'{{__('Color Name is Required Field...Please Add Color Name')}}'
           },
           total:{
            required:'{{__('Fabrics Pieces is Required Field...Please Add Fabrics Pieces')}}',
            maxlength: '{{__(' Sorry...it is allowed to enter 8 characters in Fabrics Pieces')}}'
           },
           weight:{
                        required:'{{__('Weight is Required Field...Please Add Weight')}}',
                        maxlength: '{{__(' Sorry...it is allowed to enter 8 characters in Weight')}}'
                       },
           totalfashion:{
            number: "{{__('Fashion Count is Numeric Field Only')}}",
           max: "{{__('Sorry...it is allowed to enter 99.99 characters in Fashion Count')}}",
           min: "{{__('Sorry...it is not allowed to enter smaller than 0 characters in Fashion Count')}}"
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
    inp.value = inp.value.replace(/Â|Ã|Å/g, 'Ç');  //   // replace (Ã-Â-Å) with (Ç).
    ink.value = inp.value.replace(/É/g, 'å'); //    // Trying to replace (É) with (å).
    int.value = inp.value.replace(/ì/g, 'í'); //    // Trying to replace (ì) with (í).
  }, 0);
});
// =============================================================================
// stop paste in input text (fabricName)
$(":input").on("paste", function (e) {
    e.preventDefault();
});
//  clear input text thread_name after submit
 $('#customers_name').val('')
 $('#phone1').val('')
 $('#phone2').val('')

// ===================================================================================
// valid email address
var emailField = document.getelementbyId ["email"];
var emailError = document.getelementbyId ["email-error"];

function validateEmail(){
if(!emailField.value.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
    emailError.innerHTML ="Please enter a valid email address";
    return false;
}
emailError.innerHTML ="";
    return true;
}

});



    </script>
@endpush
