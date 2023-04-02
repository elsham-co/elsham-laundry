 
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('View All Samples Order')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-vial">{{__('View All Samples Order')}}</h3>
            </div>

           
                       
                <div class="col-12 mt-5 mb-3" id="searchbox">
                    {{-- @include('core::search',['route'=>'SamplesOrder']) --}}
                    @include('samples::SamplesOrder/filter_sampleOrder',['route'=>'SamplesOrder','data'=>$CustomerName,
                    'users'=>$UsersName,'FabricName'=>$FabricName])
                    <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
                </div>
            <br>

            <div class="row justify-content-center" style="height: auto;">  
                <div class="col-xl-3 col-md-6">
                   <div class="card text-white" align="center">
                     <div class="card-body text-white">{{__('All Samples Order')}}
                     <h2 class="fas fa-user" id="forward_samples" > {{$count_unDelivered}}</h2>
                   </div>
                   </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                      <div class="card-body text-white" align="center">{{__('Samples In Lab')}}
                       <h2 class="fas fa-flask" id="inlab_samples" > {{$countsampleinlab}}</h2>
                       </div>
                      <div class="card-footer bg-secondary d-flex align-items-center justify-content-between">
                      <a class="small text-white stretched-link" href="{{route('inlabSample.index')}}">{{__('View Details')}}</a>
                      <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                    </div>
                 </div>
            </div>

            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('samples::SamplesOrder/sample_order_table',['sample_orders'=>$sample_orders])
              
                </div>
 {{-- -------------------------------------------------------------------------------------------- --}}
 <div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('View canceled Sample Orders')}}</i>
    </div>
    {{-- <hr>
    <div class="custom-cm__item" id="custom-cm__item2">
        <i class="fa fa-file-excel">  {{__('Expert to Excel Sheet')}}</i>
    </div>
    <hr> --}}
    {{-- view print dialoge in iframe for subpage --}}
    {{-- <div class="custom-cm__item"  id="custom-cm__item3" onclick="PrintAssessment();">
       
        <i class="fas fa-print">  {{__('Print')}}</i>
        <div id="colors.print" style="display:none" ></div>
    </div> --}}
 </div>
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>

            <!-- END Portlet -->
    


@endsection
@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
<script>
$("#filter_btn").click(function(e){
                e.preventDefault()
                
                    var rows = parseInt($(this).val())
                    var search = $("#search").val()
                    // var order = $("#order_type").val()
                    var date_from = $("#date_from").val()
                    var date_to = $("#date_to").val()
                    var date_type = $("#date_type option:selected").val()
                    var user_list = $("#user_list option:selected").val()
                    var fabric = $("#fabric option:selected").val()
                    var customer_type = $("#customer_type option:selected").val()
                    var Receiver = $("#Receiver option:selected").val()

                $.ajax({
                    url:"{{route('SamplesOrder.index')}}",
                    // data:{rows,search,date_from,date_to,Receiver,user_list,fabric,customer_type,order},
                    data:{rows,search,date_from,date_to,Receiver,user_list,fabric,customer_type,date_type},
                    success:function (res) {
                       $(".data").html(res)
                    //    $("#customer_type :selected").text(customer_type);
                     
                    }
                })
            })
         //   ===================================
     function change_fromlab_date(samplecode) {
        // var val =samplecode
            var url = '{{route('Fromlab_date.update','samplecode')}}'
            url = url.replace('samplecode', samplecode)
            swal.fire({
                title: "{{__('Are You Sure To Accept Samples From Lab?')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "",
                cancelButtonColor: "#d33",
                confirmButtonText: `

                    <form action="` + url + `" method="POST">
                        @method('PUT')
                @csrf

                <button type='submit' class='btn btn-primary'>{{__('Yes, Change It!')}}</button>
                    </form>
                    `,
                cancelButtonText: "<button  class='btn btn-danger' onclick='returnGroup("+samplecode+")'>{{__('Cancel')}}</button>"
            })
        }
        // ============================================================================
function delete_sampleorder(id) {

var url = '{{route('SamplesOrder.destroy','id')}}'
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
       
// // context menu Items
$("#custom-cm__item1").click(function() {
window.location.href = "{{route('SamplesOrder.trashed.index')}}";
});

// $("#custom-cm__item2").click(function() {
// window.location.href = "{{route('colors.xlsx')}}";
// });
// // view print dialoge in iframe for subpage
// $("#custom-cm__item3").click(function() {
// PrintAssessment(); 
// });
// function PrintAssessment() {
// // alert("Print the little page");
// var div = document.getElementById("colors.print");
//   div.innerHTML = '<iframe src="/colors/print" onload="this.contentWindow.print();"></iframe>';
// }
// view print dialoge in iframe for subpage by //cntrl + p
// =========================================================================
// $(document).keydown(function(event) {
// if (event.ctrlKey==true && (event.which == '80')) { //cntrl + p
// event.preventDefault();
// PrintAssessment();
// }
// });
// =========================================================================================================
$("#deliversampleModal").on("show.bs.modal", function (e) {
    $('#testsampleHeading').html(" {{__('Deliver To Customer')}}");
    $('#samplecode').prop('readonly', true);
    $('#customers_name').prop('readonly', true);

                    var id = $(e.relatedTarget).data('target-id');
                    var code = $(e.relatedTarget).data('target-code');
                    var name = $(e.relatedTarget).data('target-name');

                    $('#pass_id').val(id);
                    $('#samplecode').val(code); 
    $('#customers_name').val(name); 
                });
//   ==========================================================
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
 //  // ========================================================================================================= --}}

// ==================================
     

    });
    </script>
@endpush



        




        
