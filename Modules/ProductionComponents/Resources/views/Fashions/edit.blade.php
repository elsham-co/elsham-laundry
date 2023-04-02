
 @extends('core::layouts.app')

 @section('title')
     {{__('Edit Fashion Stage')}}
 @endsection
 @push('css')
 <link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
     {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
 @endpush
 @section('content')
     <header class="head_name" >
         <h3 class="fa fa-vest-patches" >
             {{__('Edit Fashion Stage')}}
        </h3>
     </header>
     <br>
     <div class="portlet">
       
         <div class="portlet-body d-flex align-items-center justify-content-center">
             <form action="{{route('Fashions.update',$Fashion->id)}}" method="POST" id="update_Fashions" enctype="multipart/form-data" autocomplete="off">
                 @method('PUT')
                 @csrf
         
             <!-- BEGIN Form Group -->
             
                 <div class="row">
                     <div class="col-md-12">
                         <div class="row">
                            <div class="form-group">
 
                                <label for="fascateg_code">{{__('Fashion Category')}} :</label>
   
                              <select class="form-control select2 area" name="fascateg_code" id="fascateg_code" >
   
                                   <option value="" disabled selected>{{__('-- Select Category --')}}</option> 

                                 @foreach($FashionCategoryName as $fashionCategory)
                                 <option value="{{$fashionCategory->fascategory_code}}"

                                      @if($fashionCategory->fascategory_code == $Fashion->fascateg_code)
                                          selected
                                      @endif
                                 >{{$fashionCategory->fascategory_code." - ".$fashionCategory->fascategory_name}}</option>
                             @endforeach

                               </select>
                           </div>
                    {{-- /       =========================================================================================== --}}
                              <div class="form-group"  >
                                     <label for="fashioncode">{{__('Fashion ID')}} :</label>
                                     
                                     <input type="text" class="form-control" value="{{$Fashion->fashioncode}}" id="fashioncode" name="fashioncode">
                                 </div>
                                 <div class="form-group">
                                     <label for=" 	fashionname">{{__('Fashion Name')}} :</label>
                                     <input type="text" class="form-control" value="{{$Fashion->fashionname}}" placeholder="{{__('Please... Enter the Fashion Name')}}" id="fashionname" name="fashionname" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                                 </div>
                    
                            
                             <div class="form-group">
                                <label for="fashioncount">{{__('Fashion Count')}} :</label>
                                <input type="text" class="form-control" value="{{$Fashion->fashioncount}}" placeholder="{{__('Please... Enter the Fashion Count')}}" id="fashioncount" name="fashioncount" onkeypress="return /[0-9\/^A-Za-z.\u0600-\u06FF/ ]/i.test(event.key)">
                            </div>
                             <div class="form-group" >
                                 <label for="fashionnotes">{{__('Colors Notes')}} :</label>
                                
                                 <textarea rows="3" cols="30" id="fashionnotes " class="form-control" name="fashionnotes" placeholder="{{__('Please... Enter The Fashion Notes')}}">{{$Fashion->fashionnotes}}</textarea>
                             </div>
                         </div>
                     </div>
     
                 <div class="text-center mt-5">
                     <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                     <a href="{{route('Fashions.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                 </div>
                 
             </form>
 
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
 
                 document.querySelector("#fascateg_code").parentElement.addEventListener("click", function(){
    const searchField = document.querySelector('.select2-search__field');
    if(searchField){
        searchField.focus();
    }
});

                 $("#update_Fashions").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        fashioncode:'required',
                        fashionname:'required',
                        // fascateg_code:'required'
                    },
                    messages:{
                        fashioncode:'{{__('Fashion ID is Required Field...Please Add Fashion ID')}}',
                        fashionname:'{{__('Fashion Name is Required Field...Please Add Fashion Name')}}',
                        // fascateg_code:'{{__('Role is required')}}',
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