<?php function isselected($value , $oldvalue){
    if($value == $oldvalue) echo 'selected';
} ?>
<form action="{{route($route.'.index')}}" id="filter_form">
    <div class="row text-center" style="margin-bottom: 15px;">
        <div class="col-md-6 col-xs-6">
            <div class="search product-search">
                <input type="text" name="search"
                       value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                       class="searchTerm" data-href="{{route($route.'.index')}}" style="width:100% !important" placeholder="{{__('What are you looking for?')}}">
                <i id="enable_filter" class="fa fa-filter fa-lg ml-5 mr-5 mt-3" style="cursor: pointer"></i>

            </div>

        </div>
    </div>

    <div class="row" id="filter_components" {{isset($_GET['date_from']) || isset($_GET['date_to']) ?'' :'hidden'}}>



        <div class="col-md-3">
            <label for="">{{__('Order Date')}}</label>
            <div class="input-group input-daterange">
                <input type="text" id="date_from" name="date_from" value="{{ $_GET['date_from'] ??'' }}" class="form-control" placeholder="From">
                <span class="input-group-text">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <input type="text" id="date_to" name="date_to" value="{{  $_GET['date_to'] ?? '' }}" class="form-control" placeholder="To">
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="brands">{{__('Registration Type')}}</label>
                <select name="type" class="form-control select2" id="type" style="width: 50%">
                    <option value="">{{__('Select')}}</option>
                    <option <?= isselected('affiliate',$_GET['type']??'') ?> value="affiliate">{{__('affiliate')}}</option>
                    <option <?= isselected('fromshop',$_GET['type']??'') ?> value="fromshop">{{__('physical')}}</option>
                    <option <?= isselected('frominternet',$_GET['type']??'') ?> value="frominternet">{{__('online')}}</option>
                    <option <?= isselected('enduser',$_GET['type']??'') ?> value="enduser">{{__('end user')}}</option>
                    <option <?= isselected('social',$_GET['type']??'') ?> value="social">{{__('social media')}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="brands">{{__('Customer Type')}}</label>
                <select name="customer_type" class="form-control select2" id="customer_type" style="width: 50%">
                    <option value="">{{__('Select')}}</option>
                    <option <?= isselected('register',$_GET['customer_type']??'') ?> value="register">{{__('registration')}}</option>
                    <option <?= isselected('customer',$_GET['customer_type']??'') ?> value="customer">{{__('customers')}}</option>
                </select>
            </div>
        </div>

        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="">{{__('Sort By')}}</label>
                <select name="orderby" id="orderby" class="form-control">
                    <option value="id">{{__('Select')}}</option>
                    <option <?= isselected('id',$_GET['orderby']??'') ?> value="id">{{__('Id')}}</option>
                </select>
            </div>
        </div>

        <div class="col-md-1 col-xs-6 mt-5 sort-type" hidden>
            <span id="up" style="cursor: pointer"><img src="{{asset('images/arrow-down-z-a-solid.svg')}}" height="21" alt=""></span>
            <span id="down" style="cursor: pointer" hidden><img src="{{asset('images/arrow-down-a-z-solid.svg')}}" height="20" alt=""></span>
            <input type="hidden" id="order_type" name="order">

        </div>

        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for=""> </label>
                <div class="form-group" >
                    <button id="filter_btn" type="submit" class="btn btn-success mt-2"> {{__('Filter')}}</button>
                    <a href="{{route($route.'.index')}}"  class="btn btn-secondary mt-2" id="reset_filter_form"> {{__('Reset')}}</a>
                </div>
            </div>
        </div>

    </div>
</form>

@push('js')
    <script>


        $(document).ready(function () {

            var type = '{{isset($_GET['order'])?$_GET['order']:''}}'
            if(type != ''){
                $(".sort-type").attr('hidden',false)
                console.log(type)
                if(type == 'desc'){
                    $("#up").attr('hidden',true)
                    $("#down").attr('hidden',false)
                }else{

                    $("#down").attr('hidden',true)
                    $("#up").attr('hidden',false)
                }
            }




            let isRtl = $("html").attr("dir") === "rtl"
            let direction = isRtl ? "bottom-left" : "bottom-right"
            $('#date_from').datepicker({
                pickerPosition: direction, // Set dropdown direction
                todayHighlight: true
            });
            $('#date_to').datepicker({
                pickerPosition: direction, // Set dropdown direction
                todayHighlight: true
            });
            $(document).on('click','#enable_filter',function (e) {
                e.preventDefault()
                console.log($("#filter_components").is(":hidden"))
                if($("#filter_components").is(":hidden")){
                    $("#filter_components").attr('hidden',false)
                }else{
                    $("#filter_components").attr('hidden',true)
                }
            })

            $(document).on('change','#orderby',function (e) {
                e.preventDefault()
                if($(this).find(":selected").val() != ''){
                    console.log('test')
                    $(".sort-type").attr('hidden',false)
                }else{
                    $(".sort-type").attr('hidden',true)
                }
            })


            $(document).on('click','#up',function (e) {
                e.preventDefault()
                $("#order_type").attr('value','desc')
            })
            $(document).on('click','#down',function (e) {
                e.preventDefault()
                $("#order_type").attr('value','asc')
            })


        })


    </script>
@endpush
