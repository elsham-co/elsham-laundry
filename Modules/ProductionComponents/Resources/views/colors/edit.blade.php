
 @extends('core::layouts.app')

@section('title')
    {{__('Edit Color Stage')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-flask" >
            {{__('Edit Color Stage')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('colors.update',$Color->id)}}" method="POST" id="update_Colors" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="colorcode">{{__('Color ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Color->colorcode}}" id="colorcode" name="colorcode">
                                </div>
                                <div class="form-group">
                                    <label for="colorname">{{__('Colors Name')}} :</label>
                                    <input type="text" class="form-control" value="{{$Color->colorname}}" placeholder="{{__('Please... Enter the Color Name')}}" id="colorname" name="colorname" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                                </div>
                   
                            <div class="form-group">

                                 <label for="colcategcode">{{__('Colors Category')}} :</label>
    
                               <select class="form-control select2 area" name="colcategcode" id="colcategcode" >
    
                                    <option value="" disabled selected>{{__('-- Select Category --')}}</option> 

                                  @foreach($ColorCategoryName as $colorCategory)
                                  <option value="{{$colorCategory->CategoryCol_code}}"

                                       @if($colorCategory->CategoryCol_code == $Color->colcategcode)
                                           selected
                                       @endif
                                  >{{$colorCategory->CategoryCol_code." - ".$colorCategory->CategoryCol_name}}</option>
                              @endforeach

                                </select>


                            </div>
                            <div class="form-group" >
                                <label for="colornotes">{{__('Colors Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="colornotes " class="form-control" name="colornotes" placeholder="{{__('Please... Enter The Color Notes')}}">{{$Color->colornotes}}</textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('colors.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>

        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#colorcode').prop('readonly', true); //  

                $("#colcategcode").select2({
                   
                    dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                    dropdownAutoWidth: true,
                });
    
                $("#colcategcode").validate().settings.ignore=[];

                document.querySelector("#colcategcode").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});

                $("#update_Colors").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        CategoryCol_code:'required',
                        CategoryCol_name:'required',
                        "colcategcode":'required'
                    },
                    messages:{
                        CategoryCol_code:'{{__('Color ID is Required Field...Please Add Color ID')}}',
                        CategoryCol_name:'{{__('Color Name is Required Field...Please Add Color Name')}}',
                        "colcategcode":'{{__('Role is required')}}',
                    },
                    errorPlacement: function (error, element) {
                        if (element.hasClass('select2') && element.next('.select2-container').length) {
                            error.insertAfter(element.next('.select2-container'));
                        }else{
                            error.insertAfter(element.append('<br />'));
                        }
                    }
                })

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
//  $('#colorname').val('')

});


    </script>
@endpush