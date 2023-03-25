@extends('core::layouts.app')

@section('title')
    {{__('Edit Fabrics')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-feather" >
            {{__('Edit Fabrics')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('Category.update',$fabcategory->id)}}" method="POST" id="Update_Fabrics" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="Categoryfab_code">{{__('Category FabricID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$fabcategory->Categoryfab_code}}" id="Categoryfab_code" name="Categoryfab_code">
                                </div>
                                <div class="form-group">
                                    <label for="Categoryfab_name">{{__('Category FabricName')}} :</label>
                                    <input type="text" class="form-control" value="{{$fabcategory->Categoryfab_name}}" placeholder="{{__('Please... Enter the Category FabricName')}}" id="Categoryfab_name" name="Categoryfab_name">
                                </div>
                   
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('Category.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#Categoryfab_code').prop('readonly', true); //  

    
                $("#categoryFabric").validate().settings.ignore=[];
                // $('#bill_icon').hide();  // hide button

                $("#Update_Fabrics").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fabric_code:'required',
                        fabricName:'required',
                        // "categoryFabric":'required'
                    },
                    messages:{
                        Categoryfab_code:'{{__('Fabric Code is Required Field...Please Add Fabric Code')}}',
                        Categoryfab_name:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                        // "categoryFabric":'{{__('Role is required')}}',
                    },
                    errorPlacement: function (error, element) {
    
                            error.insertAfter(element.append('<br />'));
                       
                    }
                })
// =========================================================================================================
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
$("#fabricName").keyup(function(){
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
$('#fabricName').on("paste", function (e) {
    e.preventDefault();
});

});


    </script>
@endpush