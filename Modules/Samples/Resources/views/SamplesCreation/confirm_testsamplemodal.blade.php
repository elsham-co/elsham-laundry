<div class="modal fade" id="testsampleModal" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">    <!--start modal-header-->
            <h4 class="modal-title fa fa-feather" id="testsampleHeading"></h4>
            <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </button>
          </div>                        <!--close modal-header-->
           <div class="modal-body d-flex align-items-center justify-content-center">
              <form  action="{{route('TestSample.confirm')}}" method="POST" id="confirm_sampletest" name="confirm_sampletest" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                @csrf

                 <!-- BEGIN Form Group -->
                                       <!-- Options -->

                         <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="" id="samplecode" name="samplecode" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required style="pointer-events: none;">
                            <label for="colorcode">{{__('SamplesOrder ID')}} :</label>
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
                      <input type="text" class="form-control" value=""  id="fabricName" name="fabricName" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
                      <label for="customers_name">{{__('Fabrics Name')}} :</label>
                  </div>
              </div>
              
              <div class="form-group">
                <div class="float-label float-label-lg">
                <input type="text" class="form-control" value=""  id="colors_code" name="colors_code" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
                <label for="colors_code">{{__('Colors Name')}} :</label>
            </div>
        </div>
        <div class="form-group">
          <div class="float-label float-label-lg">
          <input type="text" class="form-control" value=""  id="fashion_code" name="fashion_code" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
          <label for="fashion_code">{{__('Fashion Name')}} :</label>
      </div>
  </div>

  <div class="form-group" >
    <div class="float-label float-label-lg">
    <textarea rows="3" cols="30" id="samplesnotes" class="form-control form-control-lg" name="samplesnotes">

    </textarea>
    <label for="samplesnotes">{{__('Samples Order Notes')}} :</label>
</div>
</div>
                        <!-- END Form Group -->   
                <button type="submit" class="btn btn-outline-success btn-lg" id="confirmBtn">{{__('Confirmation')}}</button>
              </form> 
           </div>
       </div>
   </div>
</div>
@push('js')
<script>
   $(document).ready(function () {


    // $("#confirm_sampletest").validate({
    //       ignore: 'input[type=hidden]',
    //       rules:{
    //         samplecode:'required',
    //         customers_name: 'required',
    //         fabricName: 'required',
    //         colors_code: 'required',
    //         fashion_code: 'required'
      

    //       },
    //       messages:{
    //         samplecode:'{{__('SamplesOrder ID is Required Field...Please SamplesOrder ID')}}',
    //         customers_name:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
    //         fabricName:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
    //         colors_code:'{{__('Color Name is Required Field...Please Add Color Name')}}',
    //         // fashion_code:'{{__('Fashion Name is Required Field...Please Add Fashion Name')}}',
            
    //       },
    //       errorElement: "div",
    //       errorPlacement: function ( error, element ) {
    //         if (element.hasClass('select2') && element.next('.select2-container').length) {
    //         error.addClass( "invalid-feedback" );
    //         error.insertAfter( element );
    //           }
    //     },
    //   highlight: function(element) {
    //     $(element).removeClass('is-valid').addClass('is-invalid');
    //   },
    //   unhighlight: function(element) {
    //     $(element).removeClass('is-invalid').addClass('is-valid');
    //   }

    //   })
//  // ========================================================================================================= --}}
$(document).on('submit','#confirm_sampletest',function (e) {
  // $("#confirmBtn").click(function(e){
                e.preventDefault()
            $.ajax({
                   
                    type:'POST',
                    url:"{{route('TestSample.confirm')}}",
                   data:   $('#confirm_sampletest').serialize(),
                   success: function(response){
                    console.log(response)
                        $('#datatable-3').load(document.URL +  ' #datatable-3');
                        $("#testsampleModal").modal('hide')
                        var countsample = $('#forward_samples').text();
                        $('#forward_samples').text(countsample-1);
                        var countinlab = $('#inlab_samples').text();
                        countinlab++;
                        $('#inlab_samples').text(+countinlab);
                        // alert(countsample);
                   },
                   error: function(error){
                    console.log(response)
                    // alert("Data not saved");
                   }
            });
// ==================================


          })
        })
</script>
 @endpush