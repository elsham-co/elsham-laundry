@extends('core::layouts.app')

@section('title')
    {{__('Create Colors Stage')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/switchery.css')}}">
        <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }
        
      </style>
    @endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-flask" >
            {{__('Create Colors Stage')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('colors.store')}}" method="POST" id="create_Colors" enctype="multipart/form-data" autocomplete="off">
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="form-group">

                                <label for="colcategcode">{{__('Colors Category')}} :</label>
   
                              <select class="form-control select2 area" name="colcategcode" id="colcategcode" data-select2-id="1" tabindex="-1" >
   
                                   <option value="" disabled selected>{{__('-- Select Category --')}}</option> 
                                   <hr>
                      <optgroup >
                 <option  value="">
                      <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                       {{__('Add new Colors Category')}}</a>
                       </option>
                         </optgroup>
                                   @foreach($ColorCategoryName1 as $colorCategory)
                                   <option id="" value="{{$colorCategory->CategoryCol_code}}"> {{ $colorCategory->CategoryCol_code." - ".$colorCategory->CategoryCol_name}} </option>
                                {{-- <option id="" value="{{$colorCategory->CategoryCol_code}}" {{ (old("CategoryCol_code") == $colorCategory ? "selected":"") }}>{{ $colorCategory->CategoryCol_code." - ".$colorCategory->CategoryCol_name}}</option> --}}
                                   @endforeach

                               </select>
                               <button type="button" id="bill_icon" >open modal</button>

                           </div>
                             <div class="form-group"  >
                                    <label for="colorcode">{{__('Color ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Color+1}}" id="colorcode" name="colorcode">
                                </div>
                                <div class="form-group">
                                    <label for="colorname">{{__('Colors Name')}} :</label>
                                    <input type="text" class="form-control" value="{{old('colorname')}}" placeholder="{{__('Please... Enter the Color Name')}}" id="colorname" name="colorname" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                                </div>
                   
                                          {{-- <div class="col-md-4"> --}}
                                            {{-- <div class="form-group">
                                                <label for="classification">{{__('Classification')}} :
                                                <input id="classification" data-toggle="toggle" data-on={{__('Sample')}} data-off={{__('Cartel')}}
                                                 type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                                                 name="classification"
                                                 {{$Sample_inlab->classification == 1 ?'checked':''}}
                                                 checked>
                                            </label>
                                            </div>  --}}
                                {{-- </div> --}}
                            
                            <div class="form-group" >
                                <label for="colornotes">{{__('Colors Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="colornotes " class="form-control" name="colornotes" placeholder="{{__('Please... Enter The Color Notes')}}"></textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Create')}}</button>
                    <a href="{{route('colors.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
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
                          <form  action="{{route('ccategory.store')}}" method="POST" id="studentForm" name="studentForm" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="form-group"  >
                                <label for="CategoryCol_code">{{__('Category ColorID')}} :</label>
                                
                                <input type="text" class="form-control" value="{{$categoryColorID+1}}" id="CategoryCol_code" name="CategoryCol_code">
                            </div>
                            <div class="form-group" >
                                <label for="CategoryCol_name">{{__('Category Colors Name')}} :</label>   
                                <input type="text" class="form-control" value="{{old('CategoryCol_name')}}" id="CategoryCol_name" name="CategoryCol_name" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
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
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
         <script type="text/javascript" src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
         <script src="{{asset('js/switchery.js')}}"></script>
         <script src="{{asset('js/uppy.min.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('#colorcode').prop('readonly', true); //  
                 $('#mainornot').bootstrapToggle();


                $("#colcategcode").select2({
                   
                    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                    dropdownAutoWidth: true,
                });
    
                $("#colcategcode").validate().settings.ignore=[];
                $('#bill_icon').hide();  // hide button

                document.querySelector("#colcategcode").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});
                $("#create_Colors").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        colorcode:'required',
                        colorname:'required',
                        colcategcode:'required'
                    },
                    messages:{
                        colorcode:'{{__('Color ID is Required Field...Please Add Color ID')}}',
                        colorname:'{{__('Color Name is Required Field...Please Add Color Name')}}',
                        colcategcode:'{{__('Color Name is Required Field...Please Add Color Name')}}',
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
                $('select[name=colcategcode]').change(function() {
    if ($(this).val() == '')
    {
document.getElementById("bill_icon").focus();
document.getElementById("bill_icon").click();
$('#colcategcode').val(''); 
// 
    }
});
// =========================================================================================================
$("#bill_icon").click(function(){
    $('student_id').val(' ');
    $('#studentForm').trigger("reset");
    //  clear input text thread_name after submit
    $('#CategoryCol_name').val(''); 
    $('#modalHeading').html("{{__('Add new Colors Category')}}");
    $('#CategoryCol_code').prop('readonly', true);
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
 $('#colorname').val('')

});


    </script>
@endpush