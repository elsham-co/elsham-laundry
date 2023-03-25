<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">    <!--start modal-header-->
            <h4 class="modal-title fas fa-users" id="modalHeading"></h4>
            <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </button>
          </div>                        <!--close modal-header-->
           <div class="modal-body d-flex align-items-center justify-content-center">
              <form  action="{{route('storecustomer')}}" method="POST" id="create_customer" name="create_customer" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                @csrf

                 <!-- BEGIN Form Group -->
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control customers_code" value="{{$CustomerID+1}}" id="customers_code" name="customers_code" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required style="pointer-events: none;">
                            <label for="customers_code">{{__('Customer ID')}} :</label>
                        </div>
                    </div>
    
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="{{old('customers_name')}}" placeholder="{{__('Please... Enter the Customer Name')}}" id="customers_name" name="customers_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)" autocomplete="off" required>
                            <label for="customers_name">{{__('Customer Name')}} :</label>
                        </div>
                        <span id="error_customers_name"></span>
                    </div>
    
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                <input type="text" class="form-control" value="{{old('phone1')}}" placeholder="{{__('Please... Enter the Phone Number 1')}}" id="phone1" name="phone1" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                                <label for="phone1">{{__('Phone Number 1')}} :</label>
                            </div>
                            <span id="error_phone1"></span>
                        </div>
    
                        <!-- END Form Group -->   
                <button type="submit" class="btn btn-outline-success btn-lg" id="saveBtn">{{__('Create')}}</button>
              </form> 
           </div>
       </div>
   </div>
</div>
@push('js')
{{-- <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script> --}}
{{-- <script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/select2.js')}}"></script> --}}
<script>


    $("#create_customer").validate({
          ignore: 'input[type=hidden]',
          rules:{
            customers_code:'required',
            customers_name: {required: true, maxlength:45,minlength: 5},
            phone1:{required: true,number: true,minlength: 8,maxlength: 11},

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
              
          },
          errorElement: "div",
          errorPlacement: function ( error, element ) {

            error.addClass( "invalid-feedback" );
            error.insertAfter( element );
        },
      highlight: function(element) {
        $(element).removeClass('is-valid').addClass('is-invalid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      }

      })
//  // ========================================================================================================= --}}
</script>
 @endpush