@extends('core::layouts.app')

@section('title')
{{__('Transformation Order')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fas fa-users" >
        {{__('Transformation Order')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('pro_follow_up.update',$tt->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @method("PUT")
                @csrf
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                    <input type="text" class="form-control" value="{{$tt->production_order}}"  id="production_order" name="production_order" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)" autocomplete="off">
                                    <label for="production_order">{{__('Production Order')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" autocomplete="off">
                                <div class="float-label float-label-lg">
                                <input type="text" class="form-control" value="{{$tt->number_voucher}}"  id="number_voucher" name="number_voucher" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                                <label for="number_voucher">{{__('Number Voucher')}} :</label>
                            </div>
                        </div>
                    </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                    <input type="text" class="form-control" value="{{$tt->data}}"  id="customer_id" name="customer_id">
                                    <label for="customer_id">{{__('Customer Name')}} :</label>
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                <input type="text" class="form-control" value="{{$tt->fabric}}"  id="fabrics_code" name="fabrics_code">
                                <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="{{$tt->total}}" id="total" name="total" onkeypress="return /[0-9]/i.test(event.key)">
                            <label for="total">{{__('Fabrics Pieces')}} :</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="float-label float-label-lg">
                        <input type="text" class="form-control" value="{{$tt->weight}}" id="weight"name="weight" onkeypress="return /[0-9]/i.test(event.key)">
                        <label for="weight">{{__('Weight')}} :</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="float-label float-label-lg">
                    <input type="text" class="form-control" value="{{$tt->totalfashion}}" id="totalfashion"name="totalfashion" onkeypress="return /[0-9]/i.test(event.key)">
                    <label for="totalfashion">{{__('Fashion Count')}} :</label>
                </div>
            </div>
        </div>

 <!-- Options -->
 <div class="col-md-6" >
    <div class="form-group">
<div class="float-label float-label-lg">
    <select  class="form-select select2 area" id="stage1" name="stage1" th:field="*{brokerCategoryCodes}" >
    <option value="" disabled selected>{{__('--choose Production Departments--')}}</option> 
     <optgroup label="صالة 1">
        <option value="  مزيل نشا "> مزيل نشا </option>
        <option value=" انزيم  "> انزيم </option>
        <option value=" انزيم بالحجر  "> انزيم بالحجر </option>
        <option value="  سحب لون "> سحب لون </option>
        <option value=" ديرتي  "> ديرتي </option>
        <option value="  اوزون "> اوزون </option>
        <option value="  تزهير "> تزهير </option>
        <option value=" ايمو  "> ايمو </option>
        <option value="  روميو "> روميو </option>
        <option value="  بودي "> بودي </option>
        <option value="  راندم "> راندم </option>
        <option value="  سولفيت "> سولفيت </option>
        <option value="  تطرية "> تطرية </option>
        <option value="  تحضير "> تحضير </option>
        <option value=" صباغة فيراري  "> صباغة فيراري </option>
        <option value="  صباغة ميراداي "> صباغة ميراداي </option>
        <option value="  صباغة مجد "> صباغة مجد </option>
        <option value="  صباغة مباشر "> صباغة مباشر </option>
        <option value="  تشحيم "> تشحيم </option>
    </optgroup>   
    <optgroup label="صالة 2">
    <option value="  مجففات "> مجففات </option>
    <option value="  ليزر "> ليزر </option>
    <option value="  العدد "> العدد </option>
    <option value="  تسليم للعميل "> تسليم للعميل </option>
    <option value="  اصلاح "> اصلاح </option>
    </optgroup>   
    <optgroup label="صالة 3">
    <option value=" يوزد  "> يوزد </option>
    <option value="  يوزد طربيزة "> يوزد طربيزة </option>
    <option value="  لزق و تطريز "> لزق و تطريز </option>
    <option value=" بويا و ترابو  ">  بويا و ترابو </option>
    <option value="  اوسكار ">  اوسكار </option>
    <option value="  فلاي ">  فلاي </option>
    <option value="  يدوي ">  يدوي </option>
    <option value="  صنفرة ">  صنفرة </option>
    <option value="  هرية ">  هرية </option>
    <option value="  تفتيح ">  تفتيح </option>
    <option value="  دباسة ">  دباسة </option>

    </optgroup>   

       </select>
<label for="stage1">{{__('Production Departments')}}  :</label>
</div>
</div>
</div>

       <!-- Options -->


                            <div class="form-group" >
                                <div class="float-label float-label-lg">
                                <textarea rows="3" cols="30" id="transaction_note" class="form-control form-control-lg" name="transaction_note">

                                </textarea>
                                <label for="transaction_note">{{__('Follow Up Notes')}} :</label>
                            </div>

                        </div>

                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Transformation')}}</button>
                    <a href="{{route('movements.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a> 
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
                $('#number_voucher').prop('readonly', true); // 
                $('#customer_id').prop('readonly', true); // 
                $('#fabrics_code').prop('readonly', true); // 
                $('#total').prop('readonly', true); // 
                $('#weight').prop('readonly', true); // 
                $('#totalfashion').prop('readonly', true); //  
                $("#create_Customers").attr("autocomplete", "off");

                $('#stage1').select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
});
$("#stage1").validate().settings.ignore=[];
            
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

                $("#create_Customers").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        customers_code:'required',
            customers_name: {required: true, maxlength:45,minlength: 5},
            phone1:{required: true,number: true,minlength: 8,maxlength: 11},
            phone2:{number: true,minlength: 8,maxlength: 11},
            email:{email: true},

          },
          messages:{
            customers_code:'{{__('Customer ID is Required Field...Please Add Customer ID')}}',
            customers_name:{
                required: '{{__('Customer Name is Required Field...Please Add Customer Name')}}',
                maxlength: '{{__('Sorry...it is allowed to enter Max 45 characters in Customer Name')}}', 
                minlength: '{{__('Sorry...it is allowed to enter Min 5 characters in Customer Name')}}'
            },

                phone1:{
                    required: "{{__('Phone Number 1 is Required Field...Please Add Phone Number 1')}}",
                    number:'{{__('Phone Number 1 is Numeric Field Only')}}',
                    maxlength:'{{__('Sorry...it is allowed to enter 11 characters in Phone Number 1')}}',
                    minlength:'{{__('Sorry...You Must Enter 8 digit At Lest in Phone Number 1')}}',
                },
                phone2:{
                    number:'{{__('Phone Number 2 is Numeric Field Only')}}',
                    maxlength:'{{__('Sorry...it is allowed to enter 11 characters in Phone Number 2')}}',
                    minlength:'{{__('Sorry...You Must Enter 8 digit At Lest in Phone Number 2')}}',
                },
                email:{
                    
                    email:'{{__('Please Enter A Valid Email Address')}}',
            
                },
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
           
// ===================================================================================================
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
