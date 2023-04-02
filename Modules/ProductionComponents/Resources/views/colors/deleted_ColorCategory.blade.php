@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('Trashed Colors Category')}}
@endsection
@section('content')


<div class="container-fluid" id="container-fluid">
    {{-- <div class="row"> --}}
        <div class="col-12">
            <div class="header-index">
                <h3 class="fa fa-flask">  {{__('Trashed Colors Category')}}</h3>
             
            </div>
            <div class="col-12 mt-5 mb-3" id="searchbox" >
             @include('core::search',['route'=>'ccategory.trashed'])
             <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
            </div>
          
            <div class="table-responsive mt-4 data">
                 
                @include('productioncomponents::Colors/deleted_ColorCategory_table',['Allcolcategory'=>$Allcolcategory]) 
            </div>   
            {{-- ---------------------------------------------------------------------------------- --}} 
            <div class="custom-cm" id="custom-cm">
               <div class="custom-cm__item" id="custom-cm__item1">
                   <i class="fa fa-table">  {{__('Back to main content')}}</i>
               </div>
        
            </div>
           {{-- ---------------------------------------------------------------------------------------------- --}}

        </div>
    {{-- </div> --}}
</div>
@endsection


@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
<script type="text/javascript">

    function restoreColCategory(id) {

        var url = '{{route('ccategory.restore','id')}}'
        url = url.replace('id', id)
        swal.fire({
            title: "{{__('Are you sure To Restore This Colors Category?')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "",
            cancelButtonColor: "#d33",
            confirmButtonText: `<a href="`+url+`" class='btn btn-primary'>{{__('Yes, Restore It!')}}</a>`,
            cancelButtonText: "<button  class='btn btn-danger'>{{__('Cancel')}}</button>"
        })
    }

    // ===========================================================================
// context menu Items
$("#custom-cm__item1").click(function() {
    window.location.href = "{{route('ccategory.index')}}";
});

// $("#custom-cm__item2").click(function() {
//     window.location.href = "{{route('ThreadsTrashed.xlsx')}}";
// });
    //   ==========================================================
        // accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#searchbox");
const Thread_Search_CHARS_REGEXP = /[0-9\/^A-Za-z\u0600-\u06FF/ ]+/;

$input.addEventListener("beforeinput", e => {
    if
    (!Thread_Search_CHARS_REGEXP.test(e.data))
   
    {
        e.preventDefault();
    }
});
// ------------------------------------------------------------------------------
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}

</script>
@endpush
