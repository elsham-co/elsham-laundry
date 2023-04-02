@extends('core::layouts.app')

@section('title')
    {{__('Update Order')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">{{__('Update Order')}}</h3>
            </div>

            <div class="portlet-body">
                {{__('Order') .' '}}<strong
                    style="color: black">{{'#'.$order->id}}</strong>{{' '. __('had delivered in ')}}<strong
                    style="color: black">{{$order->order_date}}</strong> {{__('and status is ')}}
                <strong style="color: black">{{$order->statusValue}}</strong>

                <form  action="{{route('orders.update',$order->id)}}" method="POST" id="update_order">
                @method('PUT')
                @csrf
                <!-- BEGIN Form Group -->
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="order_status">{{__('Status')}}</label>
                                        <select name="status" class="form-control select2" id="order_status">
                                            <option value="">{{__('Select')}}</option>
                                            <option
                                                value="0" {{$order->statusValue == 0?'selected':''}}>{{__('Pending')}}</option>
                                            <option
                                                value="1" {{$order->statusValue == 1?'selected':''}}>{{__('Processing')}}</option>
                                            <option
                                                value="2" {{$order->statusValue == 2?'selected':''}}>{{__('Shipped')}}</option>
                                            <option
                                                value="3" {{$order->statusValue == 3?'selected':''}}>{{__('Completed')}}</option>
                                            <option
                                                value="4" {{$order->statusValue == 4?'selected':''}}>{{__('Cancelled')}}</option>
                                            <option
                                                value="5" {{$order->statusValue == 5?'selected':''}}>{{__('Refunded')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="order_note">{{__('Order Note')}}</label>
                                        <textarea name="note" class="form-control" id="order_note" cols="7"
                                                  rows="3">{{$order->note??''}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label for="order_status">{{__('Products')}}</label>
                                <select name="products" class="form-control select2" id="products">
                                    <option value="">{{__('Select')}}</option>
                                    @foreach($order['products'] as $product)
                                        <option data-options="{{$product->options}}" data-colors="{{$product->colors}}"  value="{{$product->id}}">{{$product->data->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="portlet">
                            <div class="portlet-header">
                                <div class="portlet-icon"><i class="fab fa-product-hunt"></i></div>
                                <h3 class="portlet-title">{{__('Products')}}</h3>
                            </div>
                            <div class="portlet-body">
                                <div class="row super-parent">
                                    @foreach($order->details as$key=> $detail)
                                        <div class="col-md-6 col-xs-6 parent-component">
                                            <div class="portlet">
                                                <div class="portlet-header">

                                                    <div class="portet-addon">
                                                        <span class="delete-color" hidden><i class="fa fa-trash fa-lg"
                                                                                      style="color: black;cursor: pointer;"></i></span>
                                                    </div>
                                                </div>

                                                <div class="portlet-body">
                                                    <div class="col-md-12 col-xs-6">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <a data-fancybox="gallery"
                                                                   href="{{asset('https://beljoumla-products.s3.us-east-2.amazonaws.com/'.DisplayImage::displayImage($detail->product->main_image))}}">
                                                                    <img style="width: 50px;border-radius: 10%;"
                                                                         src="{{asset('https://beljoumla-products.s3.us-east-2.amazonaws.com/'.DisplayImage::displayImage($detail->product->main_image))}}"
                                                                         alt="">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <strong
                                                                    style="white-space: initial; font-size: 1.2em; color: black">{{$detail->product->data()->product_name ??$detail->product->data()->first()->product_name}}</strong>
                                                                <br>
                                                                <span
                                                                    class="mt-2">{{__('barcode')}} : {{$detail->product->barcode}}</span>
                                                                <br>
                                                                <span>{{__('sku')}} : {{$detail->product->sku}}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong
                                                                    style="white-space: initial; font-size: 1.2em; color: black">{{__('Vendor')}}</strong>
                                                                <br>
                                                                <span
                                                                    class="mt-2 mb-3">{{$detail->product->vendor->shop_name??''}}</span>
                                                                <br>
                                                                <strong class="mt-4"
                                                                        style="white-space: initial; font-size: 1.2em; color: black">{{__('Pieces Per Seri')}}</strong>
                                                                <br>
                                                                <span
                                                                    class=" badge badge-primary mt-2">{{$detail->product->seri_count??''}} {{__('Piece')}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12 text-center component">
{{--                                                        <h5 class="mb-2">{{__('Choose Quantity Type')}}</h5>--}}
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input" type="radio"--}}
{{--                                                                   class="radio-seri"--}}
{{--                                                                   onclick="radioSeri({{$key}})" data-count="{{$detail->seri_count}}"--}}
{{--                                                                   data-id="{{$key}}" data-seri="{{$detail['qty'] / $detail['seri_count']}}"--}}
{{--                                                                   data-price="{{$detail['product_saleprice'] ??$detail['product_price']}}"--}}
{{--                                                                                       name="flexRadioDefault"--}}
{{--                                                                                       id="rad_seri_{{$key}}"--}}
{{--                                                                   name="product[{{$key}}][qty_type_seri]"--}}
{{--                                                            {{$detail['quantity_type'] != 'piece' ? 'checked=checked':''}}--}}
{{--                                                            >--}}
{{--                                                            <label--}}
{{--                                                                class="form-check-label" >--}}
{{--                                                                {{__('seri')}}--}}
{{--                                                            </label>--}}

{{--                                                        </div>--}}
{{--                                                        <div class="form-check form-check-inline">--}}
{{--                                                            <input class="form-check-input"--}}
{{--                                                                   type="radio" name="product[{{$key}}][qty_type_piece]"--}}
{{--                                                                   class="radio-piece" data-piece="{{$detail['qty']}}" data-count="{{$detail->seri_count}}"--}}
{{--                                                                   name="flexRadioDefault"--}}
{{--                                                                   id="rad_piece_{{$key}}"--}}
{{--                                                                   data-price="{{$detail['product_saleprice'] ??$detail['product_price']}}"--}}
{{--                                                                   onclick="radioPiece({{$key}})"--}}
{{--                                                                {{$detail['quantity_type'] == 'piece'? 'checked=checked':''}}--}}

{{--                                                            >--}}
{{--                                                            <label--}}
{{--                                                                class="form-check-label">{{__('piece')}}--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <input type="hidden" name="product[{{$key}}][id]" value="{{$detail->id}}">
                                                            <input type="hidden" id="product_type_{{$key}}" name="product[{{$key}}][type]" value="{{$detail['quantity_type']}}">
                                                            <!-- <input type="hidden" id="product_price_{{$key}}" name="product[{{$key}}][price]" value="{{$detail['product_saleprice'] ??$detail['product_price']}}"> -->
                                                            <!-- <input type="hidden" name="product[{{$key}}][seri_count]" id="product_seri_count_{{$key}}" value="{{$detail['seri_count']}}"> -->
                                                            
                                                            

                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <label>{{__('Price')}}</label>
                                                                        <?php $price = $detail['product_saleprice'] ? $detail['product_saleprice'] : $detail['product_price'] ?>
                                                                        <input type="number" min="0" onclick="updateconfirmPrice(this,{{floatval($price)}})" onchange="changeQty({{$key}})"
                                                                               value="{{$price }}"
                                                                               data-qty="{{$price}}" 
                                                                               name="product[{{$key}}][price]"
                                                                               class="form-control " id="product_price_{{$key}}" >
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <label>{{__('Seri Count')}}</label>
                                                                        <input type="number" min="0" onchange="changeQty({{$key}})"
                                                                               value="{{ $detail['seri_count'] }}"
                                                                               data-qty="{{ $detail['seri_count'] }}" 
                                                                               name="product[{{$key}}][seri_count]"
                                                                               class="form-control " id="product_seri_count_{{$key}}" >
                                                                </div>
                                                            </div>

                                                            <h5 for="order_status">{{__('Product Quantity')}}
                                                                @if($detail['quantity_type'] == 'piece')
                                                                    ({{__('piece')}})
                                                                @else
                                                                      ({{__('seri')}})
                                                                @endif
                                                            </h5>
                                                            @if(($detail->colors == '{}' || $detail->colors == '[]' || $detail->colors == '') && ($detail->sizes == '' || $detail->sizes == '{}' || $detail->sizes == '[]'))

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="number" min="0" onchange="changeQty({{$key}})"
                                                                               value="{{$detail['qty']}}"
                                                                               data-qty="{{$detail['qty']}}" name="product[{{$key}}][qty]"
                                                                               class="form-control " id="product_qty_{{$key}}" >

                                                                        <input type="hidden" class="product-total" id="pro_total_{{$key}}" value="{{$detail['quantity_type'] == 'piece' ?$detail['qty'] * ($detail['product_saleprice'] ??$detail['product_price']) :($detail['product_saleprice'] ??$detail['product_price']) * $detail['qty'] * $detail['seri_count']}}">
                                                                    </div>
                                                                </div>
                                                            @elseif($detail->colors != '{}' && ($detail->sizes == '[]' || $detail->sizes == ''))
                                                                <div class="row text-center">
                                                                    @foreach(json_decode($detail->colors,true) as$clrKey=> $qty)
                                                                        <div class="col-md-4 mt-3">
                                                                            <div class="form-group">
{{--                                                                                <input type="hidden" name="product[{{$key}}][color]" value="{{$clrKey}}">--}}
                                                                                <label style="color: {{$key == 'white'? '':$key}}">{{$clrKey}}</label>
                                                                                <input type="number" min="0" class="form-control pro-clr-total" name="product[{{$key}}][color][{{$clrKey}}][qty]" id="clr_qty_{{$key}}_{{$clrKey}}" data-color="{{$clrKey}}" value="{{$qty}}" onchange="changeClr({{$key}},'{{$clrKey}}')" >
                                                                                <input type="hidden" class="product-color-total" id="pro_clr_total_{{$key}}_{{$clrKey}}" value="{{$detail['quantity_type'] == 'piece' ?$qty * ($detail['product_saleprice'] ??$detail['product_price']) :($detail['product_saleprice'] ??$detail['product_price']) * $qty * $detail['seri_count']}}">

                                                                            </div>

                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                @elseif(($detail->colors == '{}' || $detail->colors == '[]' || $detail->colors == '') && $detail->sizes != '[]')

                                                                <div class="row ">
                                                                    @foreach(json_decode($detail->sizes,true) as $sizeKey=> $qty)
                                                                        @if(isset($qty['color']))
                                                                            <div class="col-md-6 mt-2">
                                                                                <div class="card">
                                                                                    <h6 class="text-center mt-3">{{$qty['color']}}</h6>
                                                                                    <hr>
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            @foreach($qty['values'] as$clr=> $value)
                                                                                                <div
                                                                                                    class="col-md-6 text-center mt-3">
                                                                                                    <div class="form-group">
                                                                                                        <label>{{$value['size']}}</label>

                                                                                                        <input type="number" min="0" class="form-control pro-color-size-total" name="product[{{$key}}][color_size][{{$qty['color']}}][{{$value['size']}}][qty]" id="color_size_qty_{{$key}}_{{$qty['color']}}_{{$value['size']}}" data-clr ="{{$qty['color']}}" data-size="{{$value['size']}}" value="{{$value['value']}}" onchange="changeClrSize({{$key}},'{{$qty['color']}}','{{$value['size']}}')" >
                                                                                                        <input type="hidden" class="product-color-size-total" id="pro_color_size_total_{{$key}}_{{$qty['color']}}_{{$value['size']}}" value="{{$detail['quantity_type'] == 'piece' ?$value['value'] * ($detail['product_saleprice'] ??$detail['product_price']) :($detail['product_saleprice'] ??$detail['product_price']) * $value['value'] * $detail['seri_count']}}">

                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        @else
                                                                            <div class="col-md-3 text-center mt-3">
                                                                                <div class="form-group">
                                                                                    <label>{{$qty['size']}}</label>
                                                                                    <input type="number" min="0" class="form-control pro-size-total" name="product[{{$key}}][size][{{$sizeKey}}][qty]" id="size_qty_{{$key}}_{{$qty['size']}}" data-size="{{$qty['size']}}" value="{{$qty['value']}}" onchange="changeSize({{$key}},'{{$qty['size']}}')" >
                                                                                    <input type="hidden" class="product-size-total" id="pro_size_total_{{$key}}_{{$qty['size']}}" value="{{$detail['quantity_type'] == 'piece' ?$qty['value'] * ($detail['product_saleprice'] ??$detail['product_price']) :($detail['product_saleprice'] ??$detail['product_price']) * $qty['value'] * $detail['seri_count']}}">

                                                                                </div>
                                                                            </div>
                                                                        @endif

                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    
                    <div class="portlet mt-5">
                        <div class="portlet-body">
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Order Status')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        @if ($order->status == 0)
                                            <span class="widget4-highlight badge bg-light text-dark badge-lg"
                                                style="font-size:15px">{{__('Pending')}}</span>
                                        @elseif ($order->status == 1)
                                            <span class="widget4-highlight badge bg-info text-dark badge-lg"
                                                style="font-size:15px">{{__('Processing')}}</span>
                                        @elseif ($order->status == 2)
                                            <span class="widget4-highlight badge bg-primary badge-lg"
                                                style="font-size:15px">{{__('Shipped')}}</span>
                                        @elseif ($order->status == 3)
                                            <span class="widget4-highlight badge bg-success badge-lg"
                                                style="font-size:15px">{{__('Completed')}}</span>
                                        @elseif ($order->status == 4)
                                            <span class=" widget4-highlight badge bg-danger badge-lg"
                                                style="font-size:15px">{{__('Cancelled')}}</span>
                                        @elseif ($order->status == 5)
                                            <span class="widget4-highlight badge bg-danger badge-lg"
                                                style="font-size:15px">{{__('Refunded')}}</span>
                                        @endif
                                        {{--                            <h3 class="widget4-highlight text-info">523</h3>--}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Payment Method')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h4 class="widget4-highlight text-dark">{{$order->paymentMethod->payment_method_title??''}}</h4>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Order Type')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h4 class="widget4-highlight text-dark">
                                            <?php echo $order->order_type ==1 ? 'محل': 'مكتب' ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Cashback (to be returned)')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h3 class="widget4-highlight text-danger">{{$order->cashback_amount}}
                                            <span>{{__('EGP')}}</span>
                                        </h3>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Order Amount')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h3 class="widget4-highlight text-success" id="order_amount">
                                            @if($order->add_from =='mobile')
                                                {{$order->total_amount - $order->shipping_cost +$order->paid_with_cashback}}
                                            @else
                                                {{$order->total_amount - $order->shipping_cost }}
                                            @endif
                                            <span>{{__('EGP')}}</span>
                                        </h3>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Shipment Amount')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h3 class="widget4-highlight text-secondary">
                                        <input type="number" min="0" onchange="calcTot()" onclick="calcTot()"
                                        value="{{$order->shipping_cost}}" name="shipping_cost" id="shipping_cost" >
                                            
                                            <span>{{__('EGP')}}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Paid With Cashback (discount)')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                        <h3 class="widget4-highlight text-info">
                                            <input type="number" min="0" onchange="calcTot()" onclick="calcTot()"
                                            value="{{$order->paid_with_cashback}}" name="discount" id="discount" >
                                            <span>{{__('EGP')}}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="widget4">
                                <div class="widget4-group">
                                    <div class="widget4-display">
                                        <h3 class="widget4-title">{{__('Total Amount')}}</h3>
                                    </div>
                                    <div class="widget4-addon">
                                    <input type="hidden" id="total2"   value="@if($order->add_from =='mobile')
                                        {{$order->total_amount - $order->shipping_cost +$order->paid_with_cashback}}
                                        @else
                                        {{$order->total_amount - $order->shipping_cost }}
                                        @endif">
                                        <h3 class="widget4-highlight text-primary" id="total">
                                            @if($order->add_from =='mobile')
                                                {{$order->total_amount}}
                                            @else
                                                {{ $order->total_amount - $order->paid_with_cashback}}
                                            @endif
                                            <span>{{__('EGP')}}</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button class="btn btn-primary btn-lg">{{__('Update')}}</button>
                        <a href="{{route('orders.index')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#order_status").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                width: '100%',
                dropdownAutoWidth: true,
            })
            $("#products").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                width: '100%',
                dropdownAutoWidth: true,
            })
            var products = '{{count($order->details)}}'
            if(products >1){
                $(".delete-color").attr('hidden',false)
            }

            $(document).on('click','.delete-color',function (e) {
                e.preventDefault()
                $(this).parent().closest($(".parent-component")).remove()
                calcTot()
            })

            $(document).on('change','#products',function (e) {
                e.preventDefault()
                var id = $('#products option:selected').val()
                    var count = $(".super-parent").children().length - 1

                $.ajax({
                    url:'{{route('orders.product')}}',
                    data:{id},
                    success:function (res) {
                        if (res) {
                            var price = res.sale_price ? res.sale_price : res.price;
                            count++
                            $(".super-parent").append(`
                                        <div class="col-md-6 col-xs-6 parent-component">
                                            <div class="portlet">
                                                <div class="portlet-header">

                                                    <div class="portet-addon">
                                                        <span class="delete-color" ><i class="fa fa-trash fa-lg"
                                                                                      style="color: black;cursor: pointer;"></i></span>
                                                    </div>
                                                </div>

                                                <div class="portlet-body">
                                                    <div class="col-md-12 col-xs-6">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <a data-fancybox="gallery"
                                                                   href="` + res.image + `">
                                                                    <img style="width: 50px;border-radius: 10%;"
                                                                           src="` + res.image + `"
                                                                         alt="">
                                                                </a>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <strong
                                                                    style="white-space: initial; font-size: 1.2em; color: black">` + res.data.product_name + `</strong>
                                                                <br>
                                                                <span
                                                                    class="mt-2">{{__('barcode')}} : ` + res.barcode + `</span>
                                                                <br>
                                                                <span>{{__('sku')}} : ` + res.sku + `</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <strong
                                                                    style="white-space: initial; font-size: 1.2em; color: black">{{__('Vendor')}}</strong>
                                                                <br>
                                                                <span
                                                                    class="mt-2 mb-3">` + res.vendor.shop_name + `</span>
                                                                <br>
                                                                <strong class="mt-4"
                                                                        style="white-space: initial; font-size: 1.2em; color: black">{{__('Pieces Per Seri')}}</strong>
                                                                <br>
                                                                <span
                                                                    class=" badge badge-primary mt-2">` + res.seri_count + ` {{__('Piece')}}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label>{{__('Price')}}</label>
                                                                    <input type="number" min="0" onclick="updateconfirmPrice(this,'+price+')" onchange="changeQty(` + count + `)"
                                                                            value="`+price+`"
                                                                            data-qty="`+price+`" 
                                                                            name="product[` + count + `][price]"
                                                                            class="form-control " id="product_price_` + count + `" >
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label>{{__('Seri Count')}}</label>
                                                                    <input type="number" min="0" onchange="changeQty(` + count + `)"
                                                                            value="` + res.seri_count + `"
                                                                            data-qty="` + res.seri_count + `" 
                                                                            name="product[` + count + `][seri_count]"
                                                                            class="form-control " id="product_seri_count_` + count + `" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12  component">
                                                        <h5 class="mb-2">{{__('Choose Quantity Type')}}</h5>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   class="radio-seri"
                                                                  data-count="` + res.seri_count + `"
                                                                   data-id="` + count + `"
                                                                   data-price="` + res.price + `"
{{--                                                                                       name="flexRadioDefault"--}}
                            id="rad_seri_` + count + `"
                                                                   name="product[` + count + `][qty_type_seri]" checked="checked"

                            >
                            <label
                                class="form-check-label" >
{{__('seri')}}
                            </label>

                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio" name="product[` + count + `][qty_type_piece]"
                                                                   class="radio-piece"  data-count="` + res.seri_count + `"
{{--                                                                   name="flexRadioDefault"--}}
                            id="rad_piece_` + count + `"
                                                                   data-price="` + res.price + `"



                                >
                                <label
                                    class="form-check-label">{{__('piece')}}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                    <div class="row test-` + count + `" id="sizes_` + count + `">
                                <input type="hidden" name="product[` + count + `][id]" value="` + res.id + `">
                                <input type="hidden" id="product_type_` + count + `" name="product[` + count + `][type]" value="seri">
                                <input type="hidden" name="product[` + count + `][status]" value="new">
                                // <input type="hidden" id="product_price_` + count + `" name="product[` + count + `][price]" value="` + res.price + `">
                            //    <input type="hidden" name="product[` + count + `][seri_count]" id="product_seri_count_` + count + `" value="` + res.seri_count + `">


                        </div>
                        </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


`)

                            if (res.colors.length <= 0) {
                                $("#sizes_" + count).append(`
                                
                                <div class="col-md-6 mt-3">
                                 <div class="form-group">
                                    <label for="order_status">{{__('Product Quantity')}}</label>
                                <input type="number" min="0" value="0" onchange="changeQty(` + count + `)"

                                        name="product[` + count + `][qty]" min="0"
                                       class="form-control " id="product_qty_` + count + `" >

                                <input type="hidden" class="product-total" id="pro_total_` + count + `">
                                                                    </div>
                                   </div>
                                `)

                                $(document).on('click', '#rad_piece_' + count, function (e) {
                                    $("#sizes_" + count).empty()

                                    $('#rad_seri_' + count).prop('checked', false)
                                    // $('#rad_piece_'+count).prop('checked',true)
                                    if (res.options) {
                                        $.each(res.options, function (key, val) {
                                            var option = val.data.option_name
                                            option.replace("'", "")
                                            $("#sizes_" + count).append(`
                                    <input type="hidden" name="product[` + count + `][id]" value="` + res.id + `">
                                <input type="hidden" id="product_type_` + count + `" name="product[` + count + `][type]" value="piece">
                                <input type="hidden" name="product[` + count + `][status]" value="new">
                            //     <input type="hidden" id="product_price_` + count + `" name="product[` + count + `][price]" value="` + res.price + `">
                            //    <input type="hidden" name="product[` + count + `][seri_count]" id="product_seri_count_` + count + `" value="` + res.seri_count + `">


                                        <div class="col-md-3 text-center mt-3">
                                              <div class="form-group">
                                                <label>` + val.data.option_name + `</label>
                                               <input type="number" min="0" class="form-control pro-size-total" name="product[` + count + `][size][` + val.data.option_name + `][qty]" id="size_qty_` + count + `_` + val.data.option_name + `" data-size="` + val.data.option_name + `" value="0" onchange="changeSize(` + count + `,'` + option + `')" >
                                              <input type="hidden" class="product-size-total" id="pro_size_total_` + count + `_` + val.data.option_name + `" value="0">
                                            </div>
                                            </div>

                                    `)
                                        })

                                    }
                                })

                                $(document).on('click', '#rad_seri_' + count, function (e) {
                                    $("#sizes_" + count).empty()
                                    $('#rad_piece_' + count).prop('checked', false);
                                    var price = res.sale_price ? res.sale_price : res.price;
                                    $("#sizes_" + count).append(`
                                     <input type="hidden" name="product[` + count + `][id]" value="` + res.id + `">
                                <input type="hidden" id="product_type_` + count + `" name="product[` + count + `][type]" value="seri">
                                <input type="hidden" name="product[` + count + `][status]" value="new">
                            //     <input type="hidden" id="product_price_` + count + `" name="product[` + count + `][price]" value="` + res.price + `">
                            //    <input type="hidden" name="product[` + count + `][seri_count]" id="product_seri_count_` + count + `" value="` + res.seri_count + `">

                               <div class="col-md-6">
                                        <div class="form-group">
                                        <label>{{__('Price')}}</label>
                                            <input type="number" min="0" onclick="updateconfirmPrice(this,'+price+')" onchange="changeQty(` + count + `)"
                                                    value="`+price+`"
                                                    data-qty="`+price+`" 
                                                    name="product[` + count + `][price]"
                                                    class="form-control " id="product_price_` + count + `" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                        <label>{{__('Seri Count')}}</label>
                                            <input type="number" min="0" onchange="changeQty(` + count + `)"
                                                    value="` + res.seri_count + `"
                                                    data-qty="` + res.seri_count + `" 
                                                    name="product[` + count + `][seri_count]"
                                                    class="form-control " id="product_seri_count_` + count + `" >
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                 <div class="form-group">
                                    <label for="order_status">{{__('Product Quantity')}}</label>
                                <input type="number" value="0" min="0" onchange="changeQty(` + count + `)"

                                        name="product[` + count + `][qty]"
                                       class="form-control " id="product_qty_` + count + `" >

                                <input type="hidden" class="product-total" id="pro_total_` + count + `">
                                                                    </div>
                                   </div>
                                `)
                                })


                            } else {
                                $.each(res.colors, function (key, val) {
                                    $("#sizes_" + count).append(`
                                           <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                             <label for="">` + val.color + `</label>
                                             <input type="text" class="form-control" value="0" id="clr_qty_` + count + `_` + val.color + `" onchange="changeClr('` + count + `','` + val.color + `')" name="product[` + count + `][color][` + val.color + `][qty]">
                                              <input type="hidden" value="0" class="product-color-total" id="pro_clr_total_` + count + `_` + val.color + `">

</div>
                                            </div>
                                    `)
                                })

                                if (res.colors) {
                                    $(document).on('click', '#rad_piece_' + count, function (e) {
                                        $("#sizes_" + count).empty()
                                        $('#rad_seri_' + count).prop('checked', false)
                                        $.each(res.colors, function (key, val) {
                                            $("#sizes_" + count).append(`
                                     <input type="hidden" name="product[` + count + `][id]" value="` + res.id + `">

                                <input type="hidden" id="product_type_` + count + `" name="product[` + count + `][type]" value="piece">
                                <input type="hidden" name="product[` + count + `][status]" value="new">
                            //     <input type="hidden" id="product_price_` + count + `" name="product[` + count + `][price]" value="` + res.price + `">
                            //    <input type="hidden" name="product[` + count + `][seri_count]" id="product_seri_count_` + count + `" value="` + res.seri_count + `">

                                                 <div class="col-md-6 mt-2">

                                                                                <div class="card">
                                                                                    <h6 class="text-center mt-3">` + val.color + `</h6>
                                                                                    <hr>
                                                                                    <div class="card-body">
                                                                                        <div class="row size-` + key + `">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
`)
                                            $.each(res.options, function (sizeKey, value) {
                                                console.log(value)
                                                $(".size-"+key).append(`

                                            <div
                                            class="col-md-6 text-center mt-3">
                                                <div class="form-group">
                                                <label>`+value.data.option_name+`</label>
                                            <input type="number" min="0" class="form-control pro-color-size-total" name="product[`+count+`][color_size][`+val.color+`][`+value.data.option_name+`][qty]" id="color_size_qty_`+count+`_`+val.color+`_`+value.data.option_name+`" data-clr ="`+val.color+`" data-size="`+value.data.option_name+`" value="0" onchange="changeClrSize(`+count+`,'`+val.color+`','`+value.data.option_name+`')" >
                                                <input type="hidden" class="product-color-size-total" id="pro_color_size_total_`+count+`_`+val.color+`_`+value.data.option_name+`" value="0">

                                                </div>
                                            </div>

                                            `)
                                            })
                                        })

                                    })
                                }

                                $(document).on('click', '#rad_seri_' + count, function (e) {
                                    $("#sizes_" + count).empty()
                                    $('#rad_seri_' + count).prop('checked', false)
                                    $.each(res.colors, function (key, val) {
                                        $("#sizes_" + count).append(`
  <input type="hidden" name="product[` + count + `][id]" value="` + res.id + `">

                                <input type="hidden" id="product_type_` + count + `" name="product[` + count + `][type]" value="seri">
                                <input type="hidden" name="product[` + count + `][status]" value="new">
                            //     <input type="hidden" id="product_price_` + count + `" name="product[` + count + `][price]" value="` + res.price + `">
                            //    <input type="hidden" name="product[` + count + `][seri_count]" id="product_seri_count_` + count + `" value="` + res.seri_count + `">

                                           <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                             <label for="">` + val.color + `</label>
                                             <input type="text" class="form-control" value="0" id="clr_qty_` + + `_` + val.color + `" onchange="changeClr('` + count + `','` + val.color + `')" name="product[` + count + `][color][` + val.color + `][qty]">
                                              <input type="hidden" value="0" class="product-color-total" id="pro_clr_total_` + count + `_` + val.color + `">

</div>
                                            </div>
                                    `)

                                    })
                                })



                            }

                        }
                    }
                })


            })

        })
        // function radioSeri(id)
        // {
        //     var radPiece= $("#rad_piece_"+id)
        //         radPiece.prop('checked',false)
        //     var val  = $('#product_qty_'+id).val()
        //     var count = $("#rad_piece_"+id).data('count');
        //     var price  = $("#rad_piece_"+id).data('price');
        //     var sum = parseInt(price) * (parseInt(val) * parseInt(count))
        //     // console.log(sum)
        //         $("#pro_total_"+id).val(sum)
        //     $(".pro-clr-total").each(function () {
        //         var color = $(this).data('color')
        //         var val  = $(this).val()
        //         var count = $("#rad_piece_"+id).data('count');
        //         var price  = $("#rad_piece_"+id).data('price');
        //         var sum = parseInt(price) * (parseInt(val) * parseInt(count))
        //         $("#pro_clr_total_"+id+'_'+color).val(sum)
        //     })
        //     $(".pro-size-total").each(function () {
        //         var size = $(this).data('size')
        //         var val  = $(this).val()
        //         console.log(size)
        //         console.log(val)
        //         var count = $("#rad_piece_"+id).data('count');
        //         var price  = $("#rad_piece_"+id).data('price');
        //         var sum = parseInt(price) * (parseInt(val) * parseInt(count))
        //         $("#pro_size_total_"+id+'_'+size).val(sum)
        //     })
        //
        //     $(".pro-color-size-total").each(function () {
        //         var size = $(this).data('size')
        //         var clr = $(this).data('clr')
        //         var val  = $(this).val()
        //         console.log(size)
        //         console.log(clr)
        //         var count = $("#rad_piece_"+id).data('count');
        //         var price  = $("#rad_piece_"+id).data('price');
        //         var clrSizeSum = parseInt(price) * (parseInt(val) * parseInt(count))
        //         console.log(clrSizeSum)
        //         $("#pro_color_size_total_"+id+'_'+clr+'_'+size).val(clrSizeSum)
        //     })
        //     calcTot()
        //
        // }
        // function radioPiece(id)
        // {
        //    $("#sizes_"+id).empty()
        //
        // }
        function calcTot()
        {
            var total = 0;

            $(".product-total").each(function () {
                total += parseInt($(this).val())
            })
            $(".product-color-total").each(function () {
                total += parseInt($(this).val())
            })
            $(".product-size-total").each(function () {

                total += parseInt($(this).val())
            })
            $(".product-color-size-total").each(function () {
                total += parseInt($(this).val())
            });
            
            var shipping_cost = parseFloat($('#shipping_cost').val());
            var discount = parseFloat($('#discount').val());

            order_total = total + shipping_cost - discount;
            $("#order_amount").html(total + ' <span> {{__('EGP')}}</span> ');
            $("#total").html(order_total + ' <span> {{__('EGP')}}</span> ');
            $("#total2").val(order_total)
        }


        function changeQty(id)
        {
            var val  = $('#product_qty_'+id).val()

            var count = $("#product_seri_count_"+id).val();
            var price  = $("#product_price_"+id).val();
            var type  = $("#product_type_"+id).val();
           var sum = 0;
            if(type == 'seri' || type == ''){

                sum = parseInt(price) * (parseInt(val) * parseInt(count))

                $("#pro_total_"+id).val(sum)
            }else{

                 sum = parseInt(price) * parseInt(val)
                $("#pro_total_"+id).val(sum)
            }
            calcTot()
        }

        function changeClr(id,code)
        {
            var val  = $('#clr_qty_'+id+'_'+code).val()

            var value = val;
            var count = $("#product_seri_count_"+id).val();
            var price  = $("#product_price_"+id).val();
            var type  = $("#product_type_"+id).val();
            var sum = 0;

            if(type == 'seri' || type == ''){

                sum = parseInt(price) * (parseInt(val) * parseInt(count))

                $("#pro_clr_total_"+id+'_'+code).val(sum);

            }else{

                var sum2 = price * val

                $("#pro_clr_total_"+id+'_'+code).val(sum2)
            }
            calcTot()
        }

        function changeSize(id,code)
        {
            console.log(id,code);

            var val  = $("#size_qty_"+id+"_"+code).val()
            var value = val;
            var count = $("#product_seri_count_"+id).val();
            var price  = $("#product_price_"+id).val();
            var type  = $("#product_type_"+id).val();
            var sum = 0;
            if(type == 'seri' || type == ''){

                sum = parseInt(price) * (parseInt(val) * parseInt(count))
                console.log(sum)
                $("#pro_size_total_"+id+'_'+code).val(sum);

            }else{

                var sum2 = price * val
                console.log(sum2)
                $("#pro_size_total_"+id+'_'+code).val(sum2)
            }
            calcTot()
        }
        function changeClrSize(id,clr,code)
        {
            var val  = $('#color_size_qty_'+id+'_'+clr+'_'+code).val()

            var value = val;
            var count = $("#product_seri_count_"+id).val();
            var price  = $("#product_price_"+id).val();
            var type  = $("#product_type_"+id).val();
            
            var sum = 0;
            if(type == 'seri' || type == ''){

                sum = parseInt(price) * (parseInt(val) * parseInt(count))
                console.log(sum)
                $("#pro_color_size_total_"+id+'_'+clr+'_'+code).val(sum);

            }else{

                var sum2 = price * val

                $("#pro_color_size_total_"+id+'_'+clr+'_'+code).val(sum2)
            }
            calcTot()
        }


    var change = true;
	function updateconfirmPrice(e,value){
		if(change){
			if (confirm('هل انت متاكد من تغيير السعر ')) {
				calcTot();
				change=false;
			} else {
				e.value =value;
			}
		}
	}
    </script>
@endpush
