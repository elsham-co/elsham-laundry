@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/threadview.css')}}">
@endpush
@section('title')
    {{__('view all Thread')}}
@endsection
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="header-index">
                <h3 class="fas fa-signature">  {{__('view all Thread')}}</h3>
            </div>
            <div class="col-12 mt-5 mb-3" id="searchbox">
             @include('core::search',['route'=>'Threads'])
             <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
            </div>
            <br>
            <div class="table-responsive mt-4 data"  style="position: relative;">
          
                @include('productioncomponents::Threads/thread_table',['threads'=>$threads]) 
            </div>
                                         {{-- -------------------------------------------------------------------------------------------- --}}
                                         @canany(['restore-thread', 'print_components'])
                                         <div class="custom-cm" id="custom-cm">
                                            @can('restore-thread')
                                            <div class="custom-cm__item" id="custom-cm__item1">
                                                <i class="fa fa-archive">  {{__('Trashed Threads')}}</i>
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
                                                <div id="print_order" style="display:none" ></div>
                                            </div>
                                            @endcan
                                         </div>
                                         @endcan
                                        {{-- ---------------------------------------------------------------------------------------------- --}}
                                      
        </div>
    </div>
</div>
@endsection


 @push('js')
 <script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
    <script  type="text/javascript">

        function delete_thread(id) {

            var url = '{{route('Threads.destroy','id')}}'
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
// context menu Items
$("#custom-cm__item1").click(function() {
    window.location.href = "{{route('Threads.trashed.index')}}";
});

$("#custom-cm__item2").click(function() {
    window.location.href = "{{route('Threads.xlsx')}}";
});
// view print dialoge in iframe for subpage
$("#custom-cm__item3").click(function() {
            PrintAssessment(); 
});
function PrintAssessment() {
        //alert("Print the little page");
        var div = document.getElementById("print_order");
              div.innerHTML = '<iframe src="/Threads/print" onload="this.contentWindow.print();"></iframe>';
    }
    // view print dialoge in iframe for subpage by //cntrl + p
// =========================================================================
$(document).keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '80')) { //cntrl + p
            event.preventDefault();
            PrintAssessment();
        }
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
// ======================================================================================
// change tale cell background color by value
$(document).ready(function()
     {  
                 $("#datatable-3 tr:not(:first)").each(function() { 
             
                     //get the value of the table cell 
                     var Colour = $(this).find("td:nth-child(4)").html();
                     $(this).find("td:nth-child(4)").css("background-color", Colour);
                     
                 });
     });
           </script>
@endpush 
