@extends('core::layouts.app')

@section('title')
    {{__('Create Stage Fashion')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vest-patches" >
            {{__('Create Stage Fashion')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('Fashions.store')}}" method="POST" id="create_Fashion" enctype="multipart/form-data" autocomplete="off">
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="form-group">

                                <label for="fascateg_code">{{__('Fashion Category')}} :</label>
   
                              <select class="form-control select2 area" name="fascateg_code" id="fascateg_code" >
   
                                   <option value="" disabled selected>{{__('-- Select Category --')}}</option> 
                                   <hr>
<optgroup >
<option  value="">
   <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
       {{__('Add new Fashions Category')}}</a>
</option>
</optgroup>
                                   @foreach($FashionCategoryName as $fashionCategory)
                                   <option id="" value="{{$fashionCategory->fascategory_code}}"> {{ $fashionCategory->fascategory_code." - ".$fashionCategory->fascategory_name}} </option>
                                 @endforeach

                               </select>
                               <button type="button" id="bill_icon" >open modal</button>

                           </div>
                            {{-- ====================================== --}}
                             <div class="form-group"  >
                                    <label for="fashioncode">{{__('Fashion ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Color+1}}" id="fashioncode" name="fashioncode">
                                </div>
                                <div class="form-group">
                                    <label for="fashionname">{{__('Fashion Name')}} :</label>
                                    <input type="text" class="form-control" value="{{old('fashionname')}}" placeholder="{{__('Please... Enter the Fashion Name')}}" id="fashionname" name="fashionname" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                                </div>
                                <div class="form-group">
                                    <label for="fashioncount">{{__('Fashion Count')}} :</label>
                                    <input type="text" class="form-control" value="{{old('fashioncount')}}" placeholder="{{__('Please... Enter the Fashion Count')}}" id="fashioncount" name="fashioncount" onkeypress="return /[0-9. ]/i.test(event.key)">
                                </div>

                            <div class="form-group" >
                                <label for="fashionnotes">{{__('Fashion Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="fashionnotes" class="form-control" name="fashionnotes" placeholder="{{__('Please... Enter The Fashion Notes')}}"></textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg" id="btn1">{{__('Create')}}</button>
                    <a href="{{route('Fashions.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
            
            {{-- =================================================================================================================== --}}
            {{-- Add New Category Fabric Modal --}}
            {{-- =================================================================================================================== --}}
            <div class="modal fade" id="ajaxModal" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      <div class="modal-header">    <!--start modal-header-->
                        {{-- <i class="fa fa-th-large" aria-hidden="true"></i> --}}
                        <h4 class="modal-title fa fa-th-large" id="modalHeading"></h4>
                        
                        <button type="button" class="btn btn-label-primary btn-icon btn-lg" data-dismiss="modal" aria-label="Close">
                            {{-- <span aria-hidden="true">&times;</span> --}}
                            <i class="fa fa-times aside-icon-minimize"></i>
                        </button>
                      </div>                        <!--close modal-header-->
                       <div class="modal-body d-flex align-items-center justify-content-center">
                          <form  action="{{route('fascategory.store')}}" method="POST" id="studentForm" name="studentForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="form-group"  >
                                <label for="fascategory_code">{{__('Category FashionID')}} :</label>
                                
                                <input type="text" class="form-control" value="{{$categoryFashionID+1}}" id="fascategory_code" name="fascategory_code">
                            </div>
                            <div class="form-group" >
                                <label for="fascategory_name">{{__('Category Fashions Name')}} :</label>   
                                <input type="text" class="form-control" value="{{old('fascategory_name')}}" id="fascategory_name" name="fascategory_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                            </div>     
                            <button type="submit" class="btn btn-success btn-lg" id="saveBtn" value="create">{{__('Create')}}</button>
                          </form> 
                       </div>
                   </div>
               </div>
           </div>
 {{-- =================================================================================================================== --}}
  {{-- =================================================================================================================== --}}
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#fashioncode').prop('readonly', true); //  

                $("#fascateg_code").select2({
                   
                    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                    dropdownAutoWidth: true,
                });
    
                $("#fascateg_code").validate().settings.ignore=[];
                $('#bill_icon').hide();  // hide button

                document.querySelector("#fascateg_code").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});

                $("#create_Fashion").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fashioncode:'required',
                        fashionname:'required',
                        fashioncount:{number: true,min: 0.2,max: 99.99},
                        fascateg_code:'required'
                    },
                    messages:{
                        fashioncode:'{{__('Fashion ID is Required Field...Please Add Fashion ID')}}',
                        fashionname:'{{__('Fashion Name is Required Field...Please Add Fashion Name')}}',
                        fascateg_code:'{{__('Fashion Category is Required Field...Please Add Fashion Name')}}',
                        fashioncount: {
                number: "{{__('Fashion Count is Numeric Field Only')}}",
                max: "{{__('Sorry...it is allowed to enter 99.99 characters in Fashion Count')}}",
                min: "{{__('Sorry...it is not allowed to enter smaller than 0.2 characters in Fashion Count')}}"},
                    },
                    

                    errorPlacement: function (error, element) {
                        if (element.hasClass('select2') && element.next('.select2-container').length) {
                            error.insertAfter(element.next('.select2-container'));
                        }else{
                            error.insertAfter(element.append('<br />'));
                        }
                    }
                })

// =========================================================================================================
                $('select[name=fascateg_code]').change(function() {
    if ($(this).val() == '')
    {
document.getElementById("bill_icon").focus();
document.getElementById("bill_icon").click();
$('#fascateg_code').val(''); 
// 
    }
});
// =========================================================================================================
$("#bill_icon").click(function(){
    $('student_id').val(' ');
    $('#studentForm').trigger("reset");
    $('#fascateg_code').val(''); 
    $('#fascategory_name').val(''); 
    $('#modalHeading').html(" {{__('Add new Fashions Category')}}");
    $('#fascategory_code').prop('readonly', true);
    $('#ajaxModal').modal('show');
});    
// =================================================================================================
$("#saveBtn").click(function(e){
$(this).html('{{__('Create')}}');
$.ajax({

    success:function(data){
        $('#studentForm').trigger("reset");
    $('#ajaxModal').modal('hide');
    // table.draw();
    },
    error:function(data){
        console.log('Error:',data);
        $("#saveBtn").html('{{__('Create')}}');
    }
});
});
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
 $('#fashionname').val('')
 $('#fashioncount').val('')
 $('#fashionnotes').val('')

});


    </script>
@endpush