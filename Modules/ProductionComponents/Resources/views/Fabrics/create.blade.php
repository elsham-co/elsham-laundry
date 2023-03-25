@extends('core::layouts.app')

@section('title')
    {{__('create new Fabrics')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-feather" >
            {{__('create new Fabrics')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('Fabrics.store')}}" method="POST" id="create_Fabrics" enctype="multipart/form-data" autocomplete="off">
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="form-group">

                                <label for="categoryFabric">{{__('Fabrics Category')}} :</label>
   
                              <select class="form-control select2 area" name="categoryFabric" id="categoryFabric" >
   
                                   <option value="" disabled selected>{{__('-- Select Category --')}}</option> 
                                   <hr>
                            <optgroup >
                           <option  value="">
                            <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                          {{__('Add new Fabrics Category')}}</a>
                             </option>
                            </optgroup>
                                   @foreach($fabCategoryName as $fabCategory)
                                   <option id="" value="{{$fabCategory->Categoryfab_code}}"> {{ $fabCategory->Categoryfab_code." - ".$fabCategory->Categoryfab_name }} </option>
                                 @endforeach

                               </select>
                               <button type="button" id="bill_icon" >open modal</button>

                           </div>

                             <div class="form-group"  >
                                    <label for="fabric_code">{{__('Fabrics ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Fabric+1}}" id="fabric_code" name="fabric_code">
                                </div>
                                <div class="form-group">
                                    <label for="fabricName">{{__('Fabrics Name')}} :</label>
                                    <input type="text" class="form-control" value="{{old('fabricName')}}" placeholder="{{__('Please... Enter the Fabric Name')}}" id="fabricName" name="fabricName">
                                </div>
                            
                        
                            <div class="form-group" >
                                <label for="fabricnotes">{{__('Fabrics Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="fabricnotes" class="form-control" name="fabricnotes" placeholder="{{__('Please... Enter the Fabric Notes')}}"></textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Create')}}</button>
                    <a href="{{route('Fabrics.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
            
            {{-- =================================================================================================================== --}}
            {{-- Add New Category Fabric Modal --}}
            {{-- =================================================================================================================== --}}
            <div class="modal fade" id="ajaxModal" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                      <div class="modal-header">    <!--start modal-header-->
                        <h4 class="modal-title" id="modalHeading"></h4>
                        <i class="fa fa-th-large" aria-hidden="true"></i>
                      </div>                        <!--close modal-header-->
                       <div class="modal-body d-flex align-items-center justify-content-center">
                          <form  action="{{route('category.store')}}" method="POST" id="studentForm" name="studentForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="form-group"  >
                                <label for="Categoryfab_code">{{__('Category FabricID')}} :</label>
                                
                                <input type="text" class="form-control" value="{{$categoryfabricID+1}}" id="Categoryfabric_code" name="Categoryfab_code">
                            </div>
                            <div class="form-group" >
                                <label for="Categoryfab_name">{{__('Category FabricName')}} :</label>   
                                <input type="text" class="form-control" value="{{old('name')}}" id="name" name="Categoryfab_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                            </div>     
                            <button type="submit" class="btn btn-success btn-lg" id="saveBtn" value="create">{{__('Create')}}</button>
                          </form> 
                       </div>
                   </div>
               </div>
           </div>
 {{-- =================================================================================================================== --}}
  {{-- =================================================================================================================== --}}
  <div class="col"></div>        
</div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#fabric_code').prop('readonly', true); //  
              
                $("#categoryFabric").select2({
                   
                    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                    dropdownAutoWidth: true,
                });
    
                $("#categoryFabric").validate().settings.ignore=[];
                $('#bill_icon').hide();  // hide button

                document.querySelector("#categoryFabric").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});


                $("#create_Fabrics").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fabric_code:'required',
                        fabricName:'required',
                        "categoryFabric":'required'
                    },
                    messages:{
                        fabric_code:'{{__('Fabric Code is Required Field...Please Add Fabric Code')}}',
                        fabricName:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                        "categoryFabric":'{{__('Role is required')}}',
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
                $('select[name=categoryFabric]').change(function() {
    if ($(this).val() == '')
    {
document.getElementById("bill_icon").focus();
document.getElementById("bill_icon").click();
// $('#categoryFabric').val('''); 
// 
    }
});


$("#bill_icon").click(function(){
    $('student_id').val(' ');
    $('#studentForm').trigger("reset");
    $('#categoryFabric').val(''); 
    $('#modalHeading').html("{{__('Add new Fabrics Category')}}");
    $('#Categoryfabric_code').prop('readonly', true);
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

        var thread_name = document.getElementById('fabricName');
       
        thread_name.onfocus=function(){
            th_name_error.innerHTML='{{__('accepts arabic and english letters and numbers')}}'
        }
        thread_name.onfocusout=function(){
            th_name_error.innerHTML=''
        }

// accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#fabricName");
const Thread_Name_CHARS_REGEXP = /[0-9\/^A-Za-z\u0600-\u06FF/ ]+/;

$input.addEventListener("beforeinput", e => {
    if
    (!Thread_Name_CHARS_REGEXP.test(e.data))
   
    {
        e.preventDefault();
    }
});
// ------------------------------------------------------------------------------
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}

//-*----------------------------------------------------------------------------
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
//=============================================================================
// stop paste in input text (fabricName)
$(":input").on("paste", function (e) {
    e.preventDefault();
});
 // clear input text thread_name after submit
 $('#fabricName').val('')

});


    </script>
@endpush