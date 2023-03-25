<div class="modal fade" id="fabricModal" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">    <!--start modal-header-->
            <h4 class="modal-title fa fa-feather" id="fabricHeading"></h4>
            <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </button>
          </div>                        <!--close modal-header-->
           <div class="modal-body d-flex align-items-center justify-content-center">
              <form  action="{{route('storefabric')}}" method="POST" id="create_fabric" name="create_fabric" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                @csrf

                 <!-- BEGIN Form Group -->
              
                           <!-- Options -->

                           <div class="form-group">
                            <div class="float-label float-label-lg mb-3">
                                <select  class="form-select select2 area" id="categoryFabric" name="categoryFabric" th:field="*{brokerCategoryCodes}">
                               <option value="" disabled selected>{{__('-- Select Category --')}}</option> 
                               @foreach($fabCategoryName as $fabCategory)
                               <option id="" value="{{$fabCategory->Categoryfab_code}}"> {{ $fabCategory->Categoryfab_code." - ".$fabCategory->Categoryfab_name }} </option>
                             @endforeach
                                   </select>
                           
                          <label for="categoryFabric">{{__('Fabrics Category')}} :</label>
                         </div>
                        </div>
          <!-- End Options -->

                         <div class="form-group">
                            <div class="float-label float-label-lg">
                            <input type="text" class="form-control" value="{{$FabricID+1}}" id="fabric_code" name="fabric_code" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" required style="pointer-events: none;">
                            <label for="fabric_code">{{__('Fabrics ID')}} :</label>
                        </div>
                    </div>
    
                  <div class="form-group">
                            <div class="float-label float-label-lg mb-3">
                            
                            <input type="text" class="form-control" value="{{old('fabricName')}}" placeholder="{{__('Please... Enter the Customer Name')}}" id="fabricName" name="fabricName" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)"required>
                            <label for="fabricName">{{__('Fabrics Name')}} :</label>
                        </div>
                    </div>
    
                        <!-- END Form Group -->   
                <button type="submit" class="btn btn-outline-success btn-lg" id="saveBtn">{{__('Create')}}</button>
              </form> 
           </div>
           <div class="col"></div>
       </div>
   </div>
</div>
@push('js')
<script>
 $('#categoryFabric').select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
  // theme: "bootstrap-5",
  // tags: true,
});
$("#categoryFabric").validate().settings.ignore=[];

    $("#create_fabric").validate({
          ignore: 'input[type=hidden]',
          rules:{
            fabric_code:'required',
           
            fabricName: {required: true, maxlength:45,minlength: 5},
            categoryFabric:'required'

          },
          messages:{
            fabric_code:'{{__('Fashion ID is Required Field...Please Add Customer ID')}}',
              fabricName:{
                required: '{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                maxlength: '{{__('Sorry...it is allowed to enter Max 45 characters in Fabric Name')}}', 
                minlength: '{{__('Sorry...it is allowed to enter Min 5 characters in Fabric Name')}}'
            },
              
              categoryFabric:'{{__('Fabric Category Name is Required Field...Please Add Fabric Category Name')}}',
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
//  // ========================================================================================================= --}}
</script>
 @endpush