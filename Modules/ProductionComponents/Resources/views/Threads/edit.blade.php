@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/threadcreate.css')}}">
@endpush
@section('title')
    {{__('Edit Thread')}}
@endsection

@section('content')
  <!-- BEGIN header -->
<header class="head_name" >
    <h3 class="fas fa-signature" style="color:rgb(75, 127, 156);">
         {{__('Edit Thread')}}
    </h3>
</header>
 <!-- BEGIN container -->
 <br>
 <br>
<div class="container" onload="changecolor()">
       <!--container body -->
       {{-- <div class="container-body"> --}}
    <form action="{{route('Threads.update',$thread->id)}}" method="POST" id="update_thread" enctype="multipart/form-data" autocomplete="off">
        @method('PUT')
        @csrf
        <!-- BEGIN Form Group -->
        {{-- <div class="row"> --}}

<div class="form-group" style="display: flex">
    <label for="thread_code" style="width:27%" >{{__('Thread ID')}} :</label>
 
    <input type="text" class="form-control" value="{{$thread->thread_code}}" id="thread_code" name="thread_code" >
</div>

<div class="form-group" style="display: flex">
    <label for="thread_name" style="width:27%" >{{__('Thread Name')}} :</label>
    <input type="text" class="form-control" value="{{$thread->thread_name}}" placeholder="{{__('Please... Enter the thread name')}}" id="thread_name" name="thread_name" oninput="validate(this)"><br>
<span id="th_name_error"></span>
</div>


<div class="form-group" style="display: flex">
    <label for="thread_color" style="width:29%;" >{{__('Thread color')}} :</label> 
     <input type="color" class="form-control form-control-color" id="thread_color" name="thread_color" ><br>
    <input type="text" class="form-control" value="{{$thread->thread_color}}" placeholder="{{__('Please... Enter the thread color')}}" id="thread_colortext" name="thread_colortext" dir="ltr" ><br>
    </div>
{{-- </div> <!--close row--> --}}

<div class="text-center mt-5">
    <button class="btn btn-primary btn-lg" id="btn">{{__('Update')}}</button>
    <a href="{{route('Threads.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
</div>
    </form> <!-- close form  "  --> 
{{-- </div>  <!-- close container body--> --}}
</div> <!-- close container-->
        @endsection
        {{--------------------------------------------------------------------------------------------------------------}}
@push('js')
<script>
     
        var thread_code = document.getElementById('thread_code');
        var thread_name = document.getElementById('thread_name');
       
        thread_code.onfocus=function(){
            thread_code.setAttribute('readonly', true)  // make thread_code readonly
        }

        thread_name.onfocus=function(){
            th_name_error.innerHTML='{{__('accepts arabic and english letters and numbers')}}'
        }
        thread_name.onfocusout=function(){
            th_name_error.innerHTML=''
        }

// accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#thread_name");
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
$("#thread_name").keyup(function(){
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
$('#thread_name').on("paste", function (e) {
    e.preventDefault();
});
$('#thread_colortext').on("paste", function (e) {
    e.preventDefault();
});

// ==================================================    
// choose color and view color value in thred color text

       document.getElementById("thread_colortext").addEventListener("click", function(e) {
  document.getElementById("thread_color").focus();
//   document.getElementById("thread_color").value = "#FFCC00";
  document.getElementById("thread_color").click();
});


// // Cache your elements
const elColorPicker = document.querySelector("#thread_color");
const elColorCode = document.querySelector("#thread_colortext");
const elBody = document.querySelector("body");

// // Change color function
const changeColor = (evt) => {
  const selectedColor = evt.currentTarget.value;
  elColorCode.value = selectedColor;
  
  elColorCode.style.backgroundColor = selectedColor;
  elColorCode.style.color='#00FF00';
//   elBody.style.backgroundColor = selectedColor;
};

// Add the Event to your input
elColorPicker.addEventListener("input", changeColor);
// ======================================================================================
// change table cell background color by value

$('document').ready(function() {
  var div = document.getElementById('thread_colortext');
  div.style.backgroundColor = div.value;
});

</script>
@endpush
