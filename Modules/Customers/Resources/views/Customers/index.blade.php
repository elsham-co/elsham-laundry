@extends('core::layouts.app')
@section('title')
    {{__('view All Customers')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('content')


  <!-- BEGIN Portlet -->

  <div class="portlet-header">
    <h3 class="fas fa-users"> {{__('view All Customers')}}</h3>
</div>


           
    {{-- <div class="col-12 mt-5 mb-3" id="searchbox"> --}}
        {{-- @include('core::search',['route'=>'Customers'])
        <span class="note">{{__('accepts arabic and english letters and numbers')}}</span> --}}
        <div class="col-12 mt-5 mb-3">
            @include('customers::Customers/customer_filter1',['route'=>'Customers','data'=>$CustomerName,
            'users'=>$UsersName])
        </div>
    {{-- </div> --}}
<br>

 
<div class="portlet">
    <div class="portlet-body table-responsive mt-4 data">
        @include('customers::Customers/customer_table',['customers'=>$customers])
  
    </div>

                {{-- -------------------------------------------------------------------------------------------- --}}
 <div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('view Deleted Customers')}}</i>
    </div>
    @can('print_components')
    <hr>
    <div class="custom-cm__item" id="custom-cm__item2">
        <i class="fa fa-file-excel">  {{__('Expert to Excel Sheet')}}</i>
    </div>
    <hr> 
    {{-- view print dialoge in iframe for subpage --}}
   <div class="custom-cm__item"  id="custom-cm__item3" onclick="PrintAssessment();">
       
        <i class="fas fa-print">  {{__('Print')}}</i>
        <div id="Customers.print" style="display:none" ></div>
    </div> 
    @endcan
</div>
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>
            <!-- END Portlet -->

@endsection
@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
    <script>
        //  $(document).on('change',"#page",function (e) {
            $("#filter_btn").click(function(e){
                e.preventDefault()
                
                    var rows = parseInt($(this).val())
                    var search = $("#search").val()
                    var order = $("#order_type").val()
                    var date_from = $("#date_from").val()
                    var date_to = $("#date_to").val()
                    var type = $("#type option:selected").val()
                    var user_list = $("#user_list option:selected").val()
                    var orderby = $("#orderby option:selected").val()
                    var customer_type = $("#customer_type option:selected").val()

                $.ajax({
                    url:"{{route('Customers.index')}}",
                    data:{rows,search,date_from,date_to,type,user_list,orderby,customer_type,order},
                    success:function (res) {
                       $(".data").html(res)
                    //    $("#customer_type :selected").text(customer_type);
                     
                    }
                })
            })

        // })

        function delete_customer(id) {

            var url = '{{route('Customers.destroy','id')}}'
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
       window.location.href = "{{route('Customers.trashed.index')}}";
       });
       
       $("#custom-cm__item2").click(function() {
       window.location.href = "{{route('Customers.xlsx')}}";
       });
       // view print dialoge in iframe for subpage
       $("#custom-cm__item3").click(function() {
       PrintAssessment(); 
       });
       function PrintAssessment() {
       // alert("Print the little page");
       var div = document.getElementById("Customers.print");
         div.innerHTML = '<iframe src="/Customers/print" onload="this.contentWindow.print();"></iframe>';
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
    //            const $input= document.querySelector("#searchbox");
    //    const Thread_Search_CHARS_REGEXP = /[0-9\/^A-Za-z\u0600-\u06FF/ ]+/;
       
    //    $input.addEventListener("beforeinput", e => {
    //        if
    //        (!Thread_Search_CHARS_REGEXP.test(e.data))
          
    //        {
    //            e.preventDefault();
    //        }
    //    });
       // ------------------------------------------------------------------------------
    //    function validate(input){
    //      if(/^\s/.test(input.value))
    //        input.value = '';
    //    }
             
       
           });
    </script>
@endpush
