 
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
{{__('Customer delivery store')}}  
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-balance-scale-right">{{__('Customer delivery store')}}  
                </h3>
            </div>



                <div class="col-12 mt-5 mb-3" id="searchbox">
                        @include('productionorders::delivery_store/filter_delivery_store',['route'=>'delivery','data'=>$CustomerName,
                        'FabricName'=>$FabricName,'ColorName'=>$ColorName,'users'=>$UserName]) 
                    <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
                </div>


            <br>





            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('productionorders::delivery_store/delivery_store_table',['delivery_store'=>$delivery_store])
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
<script>
$("#filter_btn").click(function(e){
                e.preventDefault()
                
                    var rows = parseInt($(this).val())
                    var search = $("#search").val()
                    // var order = $("#order_type").val()
                    var date_from = $("#date_from").val()
                    var date_to = $("#date_to").val()
                    // var type = $("#type option:selected").val()
                    var user_list = $("#user_list option:selected").val()
                    var fabric = $("#fabric option:selected").val()
                    var customer_type = $("#customer_type option:selected").val()
                    var colors = $("#colors option:selected").val()

                $.ajax({
                    url:"{{route('delivery.index')}}",
                    data:{rows,search,date_from,date_to,colors,user_list,fabric,customer_type},
                    success:function (res) {
                       $(".data").html(res)
                     
                    }
                })
            })

     function change_fromlab_date(samplecode) {
       
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



        




        
