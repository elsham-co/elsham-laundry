
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('view all Fabrics')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-feather">{{__('view all Fabrics')}}</h3>
            </div>

           
                       
                <div class="col-12 mt-5 mb-3" id="searchbox">
                    @include('core::search',['route'=>'Fabrics'])
                    <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
                </div>
            <br>

             
            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('productioncomponents::Fabrics/fabrics_table',['Fabrics'=>$Fabrics])
              
                </div>
 {{-- -------------------------------------------------------------------------------------------- --}}
 @canany(['restor-fabric', 'print_components'])
 @can('restor-fabric')
 <div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('Trashed Fabrics')}}</i>
    </div>
    @endcan
    @can('print_components')
    <hr>
    <div class="custom-cm__item" id="custom-cm__item2">
        <i class="fa fa-file-excel">  {{__('Expert to Excel Sheet')}}</i>
    </div>
    <hr>
    {{-- view print dialoge in iframe for subpage --}}
    <div class="custom-cm__item"  id="custom-cm__item3" onclick="PrintAssessment();">
       
        <i class="fas fa-print">  {{__('Print')}}</i>
        <div id="Fabrics.print" style="display:none" ></div>
    </div>
    @endcan
 </div>
 @endcan
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>

            <!-- END Portlet -->
    


@endsection
@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
<script>

function delete_fabric(id) {

var url = '{{route('Fabrics.destroy','id')}}'
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
//////===========================================================================
    $(document).ready(function () {
       
// context menu Items
$("#custom-cm__item1").click(function() {
window.location.href = "{{route('Fabrics.trashed.index')}}";
});

$("#custom-cm__item2").click(function() {
window.location.href = "{{route('Fabrics.xlsx')}}";
});
// view print dialoge in iframe for subpage
$("#custom-cm__item3").click(function() {
PrintAssessment(); 
});
function PrintAssessment() {
// alert("Print the little page");
var div = document.getElementById("Fabrics.print");
  div.innerHTML = '<iframe src="/Fabrics/print" onload="this.contentWindow.print();"></iframe>';
}
// view print dialoge in iframe for subpage by //cntrl + p
// =========================================================================
$(document).keydown(function(event) {
if (event.ctrlKey==true && (event.which == '80')) { //cntrl + p
event.preventDefault();
PrintAssessment();
}
});
 ///// ==========================================================
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
/////// ------------------------------------------------------------------------------
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}
      

    });
    </script>
@endpush



        