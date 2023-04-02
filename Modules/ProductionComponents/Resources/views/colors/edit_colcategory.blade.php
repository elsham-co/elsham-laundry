@extends('core::layouts.app')

@section('title')
    {{__('Edit Colors Category')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-feather" >
            {{__('Edit Colors Category')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('ccategory.update',$colcategory->id)}}" method="POST" id="Update_Colors" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="CategoryCol_code">{{__('Category ColorID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$colcategory->CategoryCol_code}}" id="CategoryCol_code" name="CategoryCol_code">
                                </div>
                                <div class="form-group">
                                    <label for="CategoryCol_name">{{__('Category Colors Name')}} :</label>
                                    <input type="text" class="form-control" value="{{$colcategory->CategoryCol_name}}" placeholder="{{__('Please... Enter the Color Category Name')}}" id="CategoryCol_name" name="CategoryCol_name">
                                </div>
                   
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('ccategory.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#CategoryCol_code').prop('readonly', true); //  

                $("#Update_Colors").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        CategoryCol_code:'required',
                        CategoryCol_name:'required',
                        // "categoryFabric":'required'
                    },
                    messages:{
                        CategoryCol_code:'{{__('Color Category ID is Required Field...Please Add Color Category ID')}}',
                        CategoryCol_name:'{{__('Color Category Name is Required Field...Please Add Color Category Name')}}',
                        // "categoryFabric":'{{__('Role is required')}}',
                    },
                    errorPlacement: function (error, element) {
    
                            error.insertAfter(element.append('<br />'));
                       
                    }
                })
// =========================================================================================================
// ===================================================================================================

        var thread_name = document.getElementById('CategoryCol_name');
       
        thread_name.onfocus=function(){
            th_name_error.innerHTML='{{__('accepts arabic and english letters and numbers')}}'
        }
        thread_name.onfocusout=function(){
            th_name_error.innerHTML=''
        }

// accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#CategoryCol_name");
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
$("#CategoryCol_name").keyup(function(){
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
// stop paste in input text (thread_name)
$('#CategoryCol_name').on("paste", function (e) {
    e.preventDefault();
});

});


    </script>
@endpush