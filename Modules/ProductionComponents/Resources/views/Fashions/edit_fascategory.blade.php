@extends('core::layouts.app')

@section('title')
    {{__('Edit Fashions Category')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vest-patches" >
             {{__('Edit Fashions Category')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('fascategory.update',$fascategory->id)}}" method="POST" id="Update_Fashions" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="fascategory_code">{{__('Category FashionID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$fascategory->fascategory_code}}" id="fascategory_code" name="fascategory_code">
                                </div>
                                <div class="form-group">
                                    <label for="fascategory_name">{{__('Category Fashions Name')}} :</label>
                                    <input type="text" class="form-control" value="{{$fascategory->fascategory_name}}" placeholder="{{__('Please... Enter the Fashion Category Name')}}" id="fascategory_name" name="fascategory_name">
                                </div>
                   
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('fascategory.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#fascategory_code').prop('readonly', true); //  

                $("#Update_Fashions").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fascategory_code:'required',
                        fascategory_name:'required',
                        // "categoryFabric":'required'
                    },
                    messages:{
                        fascategory_code:'{{__('Fashion Category ID is Required Field...Please Add Fashion Category ID')}}',
                        fascategory_name:'{{__('Fashion Category Name is Required Field...Please Add Fashion Category Name')}}',
                        // "categoryFabric":'{{__('Role is required')}}',
                    },
                    errorPlacement: function (error, element) {
    
                            error.insertAfter(element.append('<br />'));
                       
                    }
                })
// =========================================================================================================
// ===================================================================================================

        var thread_name = document.getElementById('fascategory_name');
       
        thread_name.onfocus=function(){
            th_name_error.innerHTML='{{__('accepts arabic and english letters and numbers')}}'
        }
        thread_name.onfocusout=function(){
            th_name_error.innerHTML=''
        }

// accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#fascategory_name");
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
$("#fascategory_name").keyup(function(){
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
$('#fascategory_name').on("paste", function (e) {
    e.preventDefault();
});

});


    </script>
@endpush