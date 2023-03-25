 
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('Follow-up stages')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-balance-scale-right"> {{__('Follow-up stages')}}</h3>
            
            </div>

           
                       
                {{-- <div class="col-12 mt-5 mb-3" id="searchbox">
                        @include('productionorders::pro_follow_up/filter_transaction',['route'=>'transaction',
                        'users'=>$UserName])
                    <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>

                </div> --}}
            <br>

            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('productionorders::pro_follow_up/transaction_table',['transaction'=>$transaction])
              
                </div>
 {{-- -------------------------------------------------------------------------------------------- --}}
 <div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('View canceled Sample Orders')}}</i>
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
$("#filter_btn").click(function(e){
                e.preventDefault()
                
                    var rows = parseInt($(this).val())
                    var search = $("#search").val()
                    var date_from = $("#date_from").val()
                    var date_to = $("#date_to").val()
                    var user_list = $("#user_list option:selected").val()


                $.ajax({
                    url:"{{route('transaction.index')}}",
                
                    data:{rows,search,date_from,date_to,user_list},
                    success:function (res) {
                       $(".data").html(res)
          
                     
                    }
                })
            })
         //   ===================================
         $("#export_btn").click(function(e){
                e.preventDefault()
                
                    var rows = parseInt($(this).val())
                    var search = $("#search").val()
                    var date_from = $("#date_from").val()
                    var date_to = $("#date_to").val()
                    var user_list = $("#user_list option:selected").val()


                $.ajax({
                    url:"{{route('transaction.xlsx')}}",
                
                    data:{rows,search,date_from,date_to,user_list},
                    success:function (res) {
                    //    $(".data").html(res)
          
                    window.location.href = "{{route('transaction.xlsx')}}";
                    }
                })
 
            })
         //   ===================================

    $(document).ready(function () {
       
// // context menu Items
$("#custom-cm__item1").click(function() {
// window.location.href = "{{route('SamplesOrder.trashed.index')}}";
});

// =========================================================================================================

//   ==========================================================
//   ==========================================================
        // accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#searchbox");
const Thread_Search_CHARS_REGEXP = /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i;

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
//-*----------------------------------------------------------------------------
     

    });
    </script>
@endpush



        




        
