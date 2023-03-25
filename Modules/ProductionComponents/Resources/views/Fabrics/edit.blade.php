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
            <form action="{{route('Fabrics.update',$Fabric->id)}}" method="POST" id="Update_Fabrics" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="fabric_code">{{__('Fabrics ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Fabric->fabric_code}}" id="fabric_code" name="fabric_code">
                                </div>

                                <div class="form-group">

                                    <label for="categoryFabric">{{__('Fabrics Category')}} :</label>
       
                                  <select class="form-control" name="categoryFabric" id="categoryFabric">
       
                                       <option value="" disabled selected>{{__('-- Select Category --')}}</option> 
   
                                       @foreach($fabCategoryName as $fabCategory)
                                       <option value="{{$fabCategory->Categoryfab_code}}"
   
                                            @if($fabCategory->Categoryfab_code == $Fabric->categoryFabric)
                                                selected
                                            @endif
                                       >{{$fabCategory->Categoryfab_code." - ".$fabCategory->Categoryfab_name }}</option>
                                   @endforeach
                                   </select>
   
                               </div>



                                <div class="form-group">
                                    <label for="fabricName">{{__('Fabrics Name')}} :</label>
                                    <input type="text" class="form-control" value="{{$Fabric->fabricName}}" placeholder="{{__('Please... Enter the Fabric Name')}}" id="fabricName" name="fabricName">
                                </div>
                   
                          
                            <div class="form-group" >
                                <label for="fabricnotes">{{__('Fabrics Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="fabricnotes" class="form-control" name="fabricnotes" placeholder="{{__('Please... Enter the Fabric Notes')}}">{{$Fabric->fabricnotes}}</textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('Fabrics.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
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
                // $('#bill_icon').hide();  // hide button

                document.querySelector("#categoryFabric").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});


                $("#Update_Fabrics").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fabric_code:'required',
                        fabricName:'required',
                        // "categoryFabric":'required'
                    },
                    messages:{
                        fabric_code:'{{__('Fabric Code is Required Field...Please Add Fabric Code')}}',
                        fabricName:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                        // "categoryFabric":'{{__('Role is required')}}',
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