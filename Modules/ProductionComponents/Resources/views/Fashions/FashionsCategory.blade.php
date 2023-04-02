
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('view all Category Fashion')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-vest-patches"> {{__('view all Category Fashion')}}</h3>
            </div>

            <div class="col-12 mt-5 mb-3" id="searchbox">
                @include('core::search',['route'=>'fascategory'])
                <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
            </div>
            
            
            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('productioncomponents::Fashions/Fascategory_table',['Allfascategory'=>$Allfascategory])
              
                </div>
 {{-- -------------------------------------------------------------------------------------------- --}}
 <div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('Trashed Fashions Category')}}</i>
    </div>
 </div>
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>

            <!-- END Portlet -->
    


@endsection
@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script> --}}
<script>

function delete_FastionCategory(id) {

var url = '{{route('fascategory.destroy','id')}}'
url = url.replace('id', id)
swal.fire({
    title: "{{__('Are you sure?')}}",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "",
    cancelButtonColor: "#d33",
    confirmButtonText: `

        <form action="` + url + `" method="POST">
            @method('DELETE')
    @csrf
    <button type='submit' class='btn btn-primary'>{{__('Yes, Delete It!')}}</button>
        </form>
        `,
    cancelButtonText: "<button  class='btn btn-danger'>{{__('Cancel')}}</button>"
})
}
// ===========================================================================
    $(document).ready(function () {
       
// context menu Items
$("#custom-cm__item1").click(function() {
window.location.href = "{{route('fascategory.trashed.index')}}";
});

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
      


   
});    


    </script>
@endpush



        