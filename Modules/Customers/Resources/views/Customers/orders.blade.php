@extends('core::layouts.app')


@section('title')
    {{__('Orders')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">{{__('Orders')}}</h3>
                    </div>

                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title"> {{ __('Customer')}} : {{$user->first_name .' '. $user->first_name }} </h3>
                    </div>

                    <div class="col-12 mt-5 mb-3">
                        @include('customers::filter',['route'=>'orders','data'=>$orders])
                    </div>

                    @can('order-preperation')
                        <div class="col-12">
                            <button id="preperation" class="btn btn-success">{{__('Orders Preperation')}}</button>
                            <button id="preperation-confirm" class="btn btn-warning">{{__('Confirm')}}</button>
                            <button id="preperation-cancel" class="btn btn-danger">{{__('Cancel')}}</button>
                        </div>
                        <div id="checkall" class="col-12">
                            <input type="checkbox" id="preperation-checkall"> {{__('Select')}} {{__('All')}}
                        </div>
                    @endcan
                    
                    <div class="portlet-body table-responsive mt-4 data">
                        @include('customers::order_table')
                    </div>
                </div>
                <!-- END Portlet -->

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/qrcode.js')}}"></script>
    <script src="{{asset('js/print.js')}}"></script>
    <script>


        function delete_order(id) {

            var url = '{{route('orders.destroy','id')}}'
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

        function printQrcode(id, qr) {
            $("#order_qr_" + id).attr('hidden', false)
            var qrcode = document.getElementById("order_qr_" + id);
            var qrcodelink = "https://beljoumla.com/?qrcode=" + qr;
            var QR_CODE = new QRCode(qrcode, {

                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",

                correctLevel: QRCode.CorrectLevel.H

            });
            QR_CODE.makeCode("" + qrcodelink + "");

            $("#order_qr_" + id).printThis();
            setTimeout(() => {
                $("#order_qr_" + id).attr('hidden', true)
                $("#order_qr_" + id).empty()
            }, 1000);
        }


        $("#preperation-confirm").hide();
        $("#preperation-cancel").hide();
        $(".preperation-checkbox").hide();
        $("#checkall").hide();

        $("#preperation").click(function () {
            $("#preperation").hide();
            $("#preperation-confirm").show();
            $("#preperation-cancel").show();
            $(".preperation-checkbox").show();
            $("#checkall").show();
        });

        $("#preperation-cancel").click(function () {
            $("#preperation").show();
            $("#preperation-confirm").hide();
            $("#preperation-cancel").hide();
            $(".preperation-checkbox").hide();
            $("#checkall").hide();
            $(".preperation-checkbox").prop("checked", false);
            $('#preperation-checkall').prop("checked", false);
        });

        $("#preperation-confirm").click(function () {
            var allids = [];
            $('.preperation-checkbox:checked').each(function () {
                allids.push($(this).val());
            });
            if (allids.length > 0) {
                window.open("{{URL::to('/').'/orders/preperation/'}}" + allids.toString(), '_self');
            }
        });

        $("#preperation-checkall").click(function () {
            $(".preperation-checkbox").prop("checked", $('#preperation-checkall').prop('checked'));
        });
    </script>
@endpush

