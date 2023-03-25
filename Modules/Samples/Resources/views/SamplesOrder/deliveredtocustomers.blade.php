<div class="modal fade" id="deliversampleModal" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">    <!--start modal-header-->
            <h4 class="modal-title fa fa-feather" id="testsampleHeading"></h4>
            <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </button>
          </div>                        <!--close modal-header-->
           <div class="modal-body d-flex align-items-center justify-content-center">
              {{-- <form  action="{{route('deliver_sample.update',$Sampleorder->id)}}" method="POST" id="deliversample" name="deliversample" class="form-horizontal" enctype="multipart/form-data" autocomplete="off"> --}}
                @if(!empty($Sampleorder)) 
                <form  action="{{route('deliver_sample.update',$Sampleorder->id)}}" method="POST" id="deliversample" name="deliversample" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf

                 <!-- BEGIN Form Group -->
                                       <!-- Options -->
                                       <input type="hidden" value="" id="pass_id" name="pass_id"> 
                         <div class="form-group">
                           
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="" id="samplecode" name="samplecode" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required style="pointer-events: none;">
                            <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                        </div>
                    </div>
    
                  <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value=""  id="customers_name" name="customers_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
                            <label for="customers_name">{{__('Customer Name')}} :</label>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="float-label float-label-lg">
                      <input type="text" class="form-control" value=""  id="Deliveredto" name="Deliveredto" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
                      <label for="Deliveredto">{{__('Delivered To')}} :</label>
                  </div>
              </div>
              
   
                        <!-- END Form Group -->   
                <button type="submit" class="btn btn-outline-success btn-lg" id="confirmBtn">{{__('Delivery Confirmation')}}</button>
              </form> 
              @endif
           </div>
       </div>
   </div>
</div>
@push('js')
<script>
   $(document).ready(function () {


    $("#deliversample").validate({
          ignore: 'input[type=hidden]',
          rules:{
            samplecode:'required',
            customers_name: 'required',
            Deliveredto: 'required'
      

          },
          messages:{
            samplecode:'{{__('SamplesOrder ID is Required Field...Please SamplesOrder ID')}}',
            customers_name:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
            Deliveredto:'{{__('Delivered To is Required Field...Please Add Delivered To')}}',

            
          },
          errorElement: "div",
          errorPlacement: function ( error, element ) {
            if (element.hasClass('select2') && element.next('.select2-container').length) {
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
//  // ========================================================================================================= --}}

        })
</script>
 @endpush