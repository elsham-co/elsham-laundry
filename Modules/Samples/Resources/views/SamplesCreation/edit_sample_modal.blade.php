  {{-- =================================================================================================================== --}}
            {{-- Edit Sample Modal --}}
            {{-- =================================================================================================================== --}}
            <div class="modal fade" id="edit_sampleModal"  role="dialog"  style="overflow:hidden;" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      <div class="modal-header" >    <!--start modal-header-->
                        <h4 class="modal-title fa fa-vial" id="edit_sampleHeading" style="font-size: 20px;"></h4>
                        <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                      </div>                        <!--close modal-header-->
                       <div class="modal-body d-flex align-items-center justify-content-center">
                        <form  action="{{route('SamplesInfo.update',$Sample_bank->id)}}" method="POST" id="update_sampleinfo" name="update_sampleinfo" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="id" id="order_id">

                                       <!-- Options -->
                                       <div class="form-group">
                                        <div class="float-label float-label-lg">
                                                       <select name="phase_name"  id="phase_name" class="form-control select2" style="font-size: 16px;font-weight: bold;">
                             <option value="">-- {{__('Select Phase Name')}} --</option>

                             <optgroup label={{__('Colors')}}>
                        
                                  @foreach($ColorsName as $singleColor)
                                 <option id="" value="{{$singleColor->colorname}}"> {{ $singleColor->colorcode." - ".$singleColor->colorname}} </option>
                                 @endforeach
                                        
                                 </optgroup>
                                 <optgroup label={{__('Fashion')}}>
                                    @foreach($FashionsName as $singleFashion)
                                    <option id="" value="{{$singleFashion->fashionname}}"> {{ $singleFashion->fashioncode." - ".$singleFashion->fashionname}} </option>
                                    @endforeach
                                     </optgroup>
                            </select>
                                            <label for="phase_name">{{__('Phase Name')}} :</label>
                                        </div>
                                    </div>


                         <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="" id="stage_notes" name="stage_notes" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                            <label for="stage_notes">{{__('Phase Note')}} :</label>
                        </div>
                    </div>  
                            <button type="submit" class="btn btn-success btn-lg" id="saveBtn" value="create">{{__('Update')}}</button>
                          </form> 
                       </div>
                   </div>
               </div>
           </div>
 {{-- =================================================================================================================== --}}
  {{-- =================================================================================================================== --}}

@push('js')
<script>

   $(document).ready(function () {


    $("#update_sampleinfo").attr("autocomplete", "off");

    $("#update_sampleinfo").validate({
          ignore: 'input[type=hidden]',
          rules:{
            phase_name:'required',
            stage_notes: {maxlength:20}
          },
          messages:{
            phase_name:'{{__('Phase Name is Required Field...Please Add Phase Name')}}',
            stage_notes:{
                            maxlength: '{{__('Sorry...it is allowed to enter 20 characters in Phase Note')}}'
                        }
            
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

// ==================================
        })
</script>
 @endpush