<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Beljoumla')}}</title>
</head>
<body>
        <div class="card" id="print_page">
            <div class="" style="background-color: #5c2283; border: none" >
                <div class="col-md-12">
                    <div class="row" style="padding-top: 40px; display: flex; justify-content: space-between; align-items: center">
                        <div class="col-md-5  text-center">
                            <img src="{{url('images/newLogo.png')}}"  alt="" style="width: 200px; height: 200px;">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5 " style="margin: 0; padding: 0;">
                            <div style="background-color: #fff; padding: 30px; left: 0; border-radius: 7px">
                                <h1 class="text-center" style="font-weight: 700">{{__('Invoice')}}</h1>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-3 text-center">
                            <h4 style="color: #fff; font-weight: 700;">{{__('Order Code')}} : {{--{{$order->id}}--}}</h4>
                        </div>
                        <div class="col-md-6 text-center">
                            <h4 style="color: #fff; font-weight: 700;">{{__('Client')}} : {{--{{$order->user?$order->user->username:$order->user->full_name}}--}}</h4>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 style="color: #fff; font-weight: 700;">{{__('Date')}} : {{--{{date('Y-m-d',strtotime($order->order_date))}}--}}</h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-body " style="margin-top: 10%">
                <table class="table   order-detail-table">
                    <thead  class="text-center">
                    <th style="color: #630e79;"><h4 style="font-weight: 700;">{{__('Product')}}</h4></th>
                    <th style="color: #630e79; font-weight: 700;"><h4 style="font-weight: 700;">{{__('Color')}}</h4></th>
                    <th style="color: #630e79; font-weight: 700;"><h4 style="font-weight: 700;">{{__('Quantity')}} ({{__('piece')}})</h4></th>
                    <th style="color: #630e79; font-weight: 700;"><h4 style="font-weight: 700;">{{__('Price')}}</h4></th>
                    <th style="color: #630e79; font-weight: 700;"><h4 style="font-weight: 700;">{{__('Total')}}</h4></th>
                    </thead>
                    <tbody>
                    {{-- @foreach ($order->details as $item) --}}
                        @php
                            // $sizes = json_decode($item->sizes,true);
                        @endphp
                        {{-- @if(($item->colors == '{}' || $item->colors == '[]' || $item->colors == '') && ($item->sizes == '[]' || $item->sizes == '')) --}}
                            <tr  class="text-center fw-bold"  >
                               <td><h4 style="font-weight:700">
                                {{-- {{$item->product->data()->product_name ??$item->product->data()->first()->product_name}} <!--<strong>x <?= $item->qty ?></strong>--> --}}
                               </h4></td>
                               <td><h4 style="font-weight:700">{{__('Not Found')}}</td>
                               {{-- <td><h4 style="font-weight:700">@if($item->quantity_type == 'piece')
                                        {{$item->qty}}
                                    @else
                                        {{$item->qty * $item->seri_count}}
                                    @endif --}}
                               </h4></td>
                               <td><h4 style="font-weight:700">
                                    <?php /* if ($item->product_saleprice != 0 && $item->quantity_type == 'seri')
                                        echo '  <span>' . floatval($item->product_saleprice) . ' '.__("EG").'</span>';
                                    else
                                        echo '<span>' . floatval($item->product_price) . '  '.__("EG"). '</span>';*/ ?>

                               </h4></td>
                               <td><h4 style="font-weight:700">

                                    <?php
                                  /*  if ($item->quantity_type == 'seri') {
                                        $quanitity = $item->qty * $item->seri_count;
                                        if ($item->product_saleprice != 0) $_price = $item->product_saleprice;
                                        else $_price = $item->product_price;
                                    } else {
                                        $quanitity = $item->qty;
                                        $_price = $item->product_price;
                                    }

                                    if ($item->product_saleprice != 0)
                                        echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';
                                    else
                                        echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';*/ ?>

                               </h4></td>
                            <tr>

                        {{-- @elseif(!empty($item->colors) && count(json_decode($item->colors,true)) > 0) --}}

                            {{-- @foreach(json_decode($item->colors,true) as $key=> $color)
                                @if($color != 0) --}}
                                <tr class="text-center fw-bold">
                                   <td><h4 style="font-weight:700">
                                        {{-- {{$item->product->data()->product_name ??$item->product->data()->first()->product_name}} <!--<strong>x <?= $item->qty ?></strong>--> --}}
                                   </h4></td>
                                   {{-- <td><h4 style="font-weight:700">{{$key}}</td> --}}
                                   <td><h4 style="font-weight:700">
                                        {{-- @if($order->quantity_type == 'piece')
                                            {{$color}}
                                        @else
                                            {{$color * $item->seri_count}}
                                        @endif --}}
                                   </h4></td>
                                   <td><h4 style="font-weight:700">
                                        <?php /*if ($item->product_saleprice != 0 && $item->quantity_type == 'seri')
                                            echo '<span>' . floatval($item->product_saleprice) . ' '. __("EG").'</span>';
                                        else
                                            echo '<span>' . floatval($item->product_price) . '  '.__("EG"). '</span>';*/ ?>

                                   </h4></td>
                                   <td><h4 style="font-weight:700">

                                        <?php
                                       /* if ($item->quantity_type == 'seri' || $item->quantity_type == 0) {
                                            $quanitity = $color * $item->seri_count;
                                            if ($item->product_saleprice != 0) $_price = $item->product_saleprice;
                                            else $_price = $item->product_price;
                                        } else {
                                            $quanitity = $color;
                                            $_price = $item->product_price;
                                        }

                                        if ($item->product_saleprice != 0)
                                            echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';
                                        else
                                            echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';*/ ?>

                                   </h4></td>
                                <tr>
                                {{-- @endif
                            {{-- @endforeach
                        @elseif(!empty($item->sizes) && count($sizes) > 0 && empty($sizes['nodata']))

                            @foreach(json_decode($item->sizes,true) as $key=> $size)

                                @if(isset($size['color']))
                                    @foreach($size['values']??[] as $value) @if($value['value']==0) @continue @endif --}} --}}

                                    <tr  class="text-center fw-bold">
                                       <td><h4 style="font-weight:700">
                                            {{-- {{$item->product->data()->product_name ??$item->product->data()->first()->product_name}} <!--<strong>x <?= $item->qty ?></strong>--> --}}
                                       </h4></td>
                                       {{-- <td><h4 style="font-weight:700">{{$size['color']}}</td> --}}
                                        @php
                                            // $qty = 0;
                                            // foreach($size['values'] as $value){
                                            //     $qty += $value['value'];
                                            // }
                                        @endphp
                                       {{-- <td><h4 style="font-weight:700">{{$qty}}</td> --}}
                                       <td><h4 style="font-weight:700">
                                            <?php /*if ($item->product_saleprice != 0 && $item->quantity_type == 'seri')
                                                echo '  <span>' . floatval($item->product_saleprice) . ' '.__("EG"). '</span>';
                                            else
                                                echo '<span>' . floatval($item->product_price) . '  '.__("EG"). '</span>';*/ ?>

                                       </h4></td>
                                       <td><h4 style="font-weight:700">

                                            <?php
                                            // if ($item->quantity_type == 'seri') {
                                            //     $quanitity = $qty * $item->seri_count;
                                            //     if ($item->product_saleprice != 0) $_price = $item->product_saleprice;
                                            //     else $_price = $item->product_price;
                                            // } else {
                                            //     $quanitity = $qty;
                                            //     $_price = $item->product_price;
                                            // }

                                            // if ($item->product_saleprice != 0)
                                            //     echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';
                                            // else
                                            //     echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>'; ?>

                                       </h4></td>
                                    <tr>
                                    {{-- @endforeach
                                @elseif(isset($size['size']) && $size['value'] !=0) --}}

                                    <tr  class="text-center fw-bold">
                                       <td><h4 style="font-weight:700">
                                        {{-- {{$item->product->data()->product_name ??$item->product->data()->first()->product_name}} <!--<strong>x <?= $item->qty ?></strong>--> --}}
                                       </h4></td>
                                       {{-- <td><h4 style="font-weight:700">{{'('.$size['size'].')' .' '.__('size')}}</td> --}}

                                       {{-- <td><h4 style="font-weight:700">{{$size['value']}}</td> --}}
                                       <td><h4 style="font-weight:700">
                                         <?php /*if ($item->product_saleprice != 0 && $item->quantity_type == 'seri')
                                                // echo '  <span>' . floatval($item->product_saleprice) . ' '.__("EG"). '</span>';
                                            else*/
                                                // echo '<span>' . floatval($item->product_price) . '  '.__("EG"). '</span>'; ?>

                                       </h4></td>
                                       <td><h4 style="font-weight:700">

                                            <?php
                                            // if ($item->quantity_type == 'seri') {
                                            //     $quanitity = $size['value'] * $item->seri_count;
                                            //     if ($item->product_saleprice != 0) $_price = $item->product_saleprice;
                                            //     else $_price = $item->product_price;
                                            // } else {
                                            //     $quanitity = $size['value'];
                                            //     $_price = $item->product_price;
                                            // }

                                            // if ($item->product_saleprice != 0)
                                            //     echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>';
                                            // else
                                            //     echo '<strong>' . floatval($_price * $quanitity) . ' '  .__("EG"). '</strong>'; ?>

                                       </h4></td>
                                    <tr>
                                {{-- @endif
                            @endforeach

                        @endif

                    @endforeach --}}
                    </tbody>

                </table>
                <div class="col-md-12 " style="margin-top: 7%">
                    <div class="row">
                        <div class="col-md-8">
                            {{-- @if(!empty($order->shipping_billing_address))
                                    <div class="customer-boxes">
                                        @php
                                            $shipping = json_decode($order->shipping_billing_address,true)['shipping'];
                                        @endphp
                                        <h4 style="color: #630e79; font-weight: 700;">{{__('Shipping Details')}} :</h4>
                                        <h4 style="font-weight: 700">
                                            <strong>
                                                {{$shipping['shipping_firstname'] .' ' .$shipping['shipping_lastname'] }}
                                            </strong><br>
                                                {{$shipping['shipping_phone']}} </br>
                                            {{$shipping['shipping_email']}} </br>
                                            {{$shipping['shipping_address']}}<br>
                                        </h4>

                                    </div>
                            @endif --}}
                        </div>
                            <div class="col-md-4">
                                <table class="table table-borderless   table-responsive">
                                    <tbody>
                                    <tr>
                                        <th style="color:#630e79"><h4 style="font-weight: 700">{{__('Order Amount')}} :</h4></th>
                                       <td><h4 style="font-weight:700">
                                            {{-- @if($order->add_from =='mobile')
                                                {{$order->total_amount - $order->shipping_cost +$order->paid_with_cashback}} {{__('EG')}}
                                            @else
                                                {{$order->total_amount - $order->shipping_cost }} {{__('EG')}}
                                            @endif --}}
                                       </h4></td>
                                    </tr>
                                    <tr>
                                        <th style="color:#630e79"><h4 style="font-weight: 700">{{__('Shipping Cost')}} :</h4></th>
                                        {{-- <td><h4 style="font-weight:700"><!--{{$order->shipping_cost}}--> {{__('EG')}}</h4></td> --}}
                                    </tr>
                                    <tr>
                                        <th style="color:#630e79"><h4 style="font-weight: 700">{{__('Discount')}} : </h4></th>
                                        {{-- <td><h4 style="font-weight:700">{{$order->paid_with_cashback}} {{__('EG')}}</h4></td> --}}
                                    </tr>
                                    </tbody>
                                </table>

                                <button class="btn mt-5" style="padding:10px 30px 10px 30px; background-color: #630e79; "><h4 style="font-size: 25px; color: #fff; font-weight: 1000;">{{__('Total')}} :
                                        {{-- @if($order->add_from =='mobile')
                                            {{$order->total_amount}}
                                        @else
                                            {{ $order->total_amount - $order->paid_with_cashback}}
                                        @endif --}}

                                        {{__('EG')}}</h4></button>
                            </div>
                    </div>
                </div>




                <div class="col-md-12" style="margin-top: 7%">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 style="font-weight: 700;"> المنطقة الصناعية- العبور <i class="fa fa-map-marker" style="color:black"></i> </h4>


                        </div>
                        <div class="col-md-3">
                            <h4 style="font-weight: 700;"> بالجمله_ملابس رجالى <i class="fab fa-telegram" style="color:cornflowerblue"></i></h4>

                        </div>
                        <div class="col-md-3">
                            <h4 style="font-weight: 700;">01288816222 <i class="fa fa-phone" style="color:black"></i></h4>


                        </div>
                        <div class="col-md-3">
                            <h4 style="font-weight: 700;">www.beljoumla.com  <i class="fa fa-home" style="color: #e1e135"></i></h4>

                        </div>
                    </div>

                </div>

            </div>
        </div>
</body>
</html>
