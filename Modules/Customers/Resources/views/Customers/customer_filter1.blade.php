<?php function isselected($value , $oldvalue){
    if($value == $oldvalue) echo 'selected';
} ?>
<form action="{{route($route.'.index')}}" id="filter_form">
    <div class="row text-center" style="margin-bottom: 15px;">
        <div class="col-md-6 col-xs-6">
            <div class="search product-search">
                <input type="text" name="search"
                       value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}"
                       class="searchTerm" data-href="{{route($route.'.index')}}" style="width:100% !important" placeholder="{{__('What are you looking for?')}}" onkeypress="return /[0-9\/^A-Za-z\u0600-\u06FF/ ]/i.test(event.key)">
                <i id="enable_filter" class="fa fa-filter fa-lg ml-5 mr-5 mt-3" style="cursor: pointer"></i>

            </div>

        </div>
    </div>

   
        <div class="row" id="filter_components" {{isset($_GET['date_from']) || isset($_GET['date_to']) || isset($_GET['user-list'])
        || isset($_GET['customer_type']) ?'' :'hidden'}}>


        <div class="col-md-3">
            <label for="">{{__('Created_at')}}</label>
            <div class="input-group input-daterange">
                <input type="text" id="date_from" name="date_from" value="{{ $_GET['date_from'] ??'' }}" class="form-control" placeholder="From">
                <span class="input-group-text">
                    <i class="fa fa-ellipsis-h"></i>
                </span>
                <input type="text" id="date_to" name="date_to" value="{{  $_GET['date_to'] ?? '' }}" class="form-control" placeholder="To">
            </div>
        </div>


        <div class="col-md-3" >
            <div class="input-group input-daterange">
                <label for="customer_type">{{__('Customer Name')}}</label>
            <select name="customer_type" class="form-control select2" id="customer_type" style="width: 50%">
                <option value="">{{__('Select')}}</option>
                @foreach($data as $CustomerName)
                <option <?= isselected($CustomerName->customers_code,$_GET['CustomerName']??'') ?> value="{{$CustomerName->customers_code}}">{{$CustomerName->customers_name}}</option>
                @endforeach
            </select>
           </div>
        </div>

        <div class="col-md-3" >
            <div class="input-group input-daterange">
                <label for="user_list">{{__('Created_by')}}</label>
            <select name="user_list" class="form-control select2" id="user_list" style="width: 50%">
                <option value="">{{__('Select')}}</option>
                @foreach($users as $UserName)
                <option <?= isselected($UserName->id,$_GET['UserName']??'') ?> value="{{$UserName->id}}">{{$UserName->username}}</option>
                @endforeach
            </select>
         
    </div>
</div>
                    <div class="text-center mt-5">
                    <button id="filter_btn" type="submit" class="btn btn-success mt-2"> {{__('Filter')}}</button>
                    <a href="{{route($route.'.index')}}"  class="btn btn-secondary mt-2" id="reset_filter_form"> {{__('Reset')}}</a>
        </div>

    </div>
</form>

@push('js')
    <script>
        $(document).ready(function () {

            $('#customer_type').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
});


            $('#user_list').select2({
        dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
        dropdownAutoWidth: true,
});

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
// -*----------------------------------------------------------------------------
$(":input").keyup(function(){
    var inp = this;
    var ink = this;
    var int = this;
  setTimeout(function() {
    inp.value = inp.value.replace(/آ|أ|إ/g, 'ا');  //   // replace (أ-آ-إ) with (ا).
    ink.value = inp.value.replace(/ة/g, 'ه'); //    // Trying to replace (ة) with (ه).
    int.value = inp.value.replace(/ى/g, 'ي'); //    // Trying to replace (ى) with (ي).
  }, 0);
});
// =============================================================================


        })


    </script>
@endpush
