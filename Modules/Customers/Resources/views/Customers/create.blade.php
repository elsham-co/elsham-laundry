@extends('core::layouts.app')

@section('title')
    {{__('Add New Customer')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fas fa-users" >
            {{__('Add New Customer')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('Customers.store')}}" method="POST" id="create_Customers" enctype="multipart/form-data" autocomplete="off">
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                    <input type="text" class="form-control" value="{{$Customers+1}}"  id="customers_code" name="customers_code">
                                    <label for="customers_code">{{__('Customer ID')}} :</label>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                    <input type="text" class="form-control" value="{{old('customers_name')}}" placeholder="{{__('Please... Enter the Customer Name')}}" id="customers_name" name="customers_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)" autocomplete="off">
                                    <label for="customers_name">{{__('Customer Name')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" autocomplete="off">
                                <div class="float-label float-label-lg">
                                <input type="text" class="form-control" value="{{old('phone1')}}" placeholder="{{__('Please... Enter the Phone Number 1')}}" id="phone1" name="phone1" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                                <label for="phone1">{{__('Phone Number 1')}} :</label>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="{{old('phone2')}}" placeholder="{{__('Please... Enter the Phone Number 2')}}" id="phone2" name="phone2" onkeypress="return /[0-9]/i.test(event.key)">
                            <label for="phone2">{{__('Phone Number 2')}} :</label>
                        </div>
                    </div>
                </div>
                                {{-- <div class="col-md-10"> --}}
                                    <div class="form-group">
                                        <div class="float-label float-label-lg">
                                            <input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Please insert your email" onkeyup="validateEmail()">
                                            <label for="email">{{__('Email')}}</label>
                                            <span id="email-error"></span>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                            <div class="form-group" >
                                <div class="float-label float-label-lg">
                                <textarea rows="3" cols="30" id="customers_notes " class="form-control form-control-lg" name="customers_notes" placeholder="{{__('Please... Enter The Customer Notes')}}"></textarea>
                                <label for="customers_notes">{{__('Customer Notes')}} :</label>
                            </div>
                        </div>

                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Create')}}</button>
                    <a href="{{route('Customers.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
            
            <div class="col"></div>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#customers_code').prop('readonly', true); //  
                $("#create_Customers").attr("autocomplete", "off");

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