@extends('core::layouts.app')
@section('title')
    {{__('Site Settings')}}
@endsection
@section('content')

    <div class="portlet">
        <div class="portlet-header portlet-header-bordered">
            <h3 class="portlet-title">{{__('Site Settings')}}</h3>
        </div>
        <div class="portlet-body">
            <form action="{{route('settings.update')}}" method="POST" id="update_settings" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- BEGIN Form Group -->
                <div class="row">
                   <div>
                       <h2 class="mb-3">{{__('Site Info')}}</h2>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('site Name')}}</label>
                                       <input type="text" class="form-control" value="{{$site->site_name}}" name="site_name">
                                   </div>
                               </div>
                               <div class="col-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('site Email')}}</label>
                                       <input type="email" class="form-control" value="{{$site->site_email}}" name="site_email">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('site Address')}}</label>
                                       <input type="text" class="form-control" value="{{$site->address}}" name="address">
                                   </div>
                               </div>
                               <div class="col-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('site Phone')}}</label>
                                       <input type="number" class="form-control" value="{{$site->phone}}" name="phone">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-6">
                                   <div class="form-group">
                                       @include('core::image',['title'=> __('site Logo'),'name'=>'image','function'=>'siteImagePreview(event)'])
                                   </div>
                                   <div class="site-image" {{$site->site_logo? '':'hidden'}}>
                                       <a href="{{asset('https://beljoumla-products.s3.us-east-2.amazonaws.com/'.DisplayImage::displayImage($site->site_logo))}}"
                                          id="site_img"  data-fancybox="gallery">
                                           <img id="site_image"
                                                src="{{asset('https://beljoumla-products.s3.us-east-2.amazonaws.com/'.DisplayImage::displayImage($site->site_logo))}}"
                                                style="margin: auto; width: 30%;"  alt="">
                                       </a>
                                   </div>

                               </div>
                               <div class="col-6">
                                   <label for="select_title">{{__('contact message')}}</label>
                                   <div class="input-group">
                                       <select class="selectpicker form-control" id="select_message" data-width="fit">
                                           <option data-content="<img src='{{asset('images/eg.png')}}'  height='16'>"
                                                   value="ar"></option>
                                           <option data-content="<img src='{{asset('images/us.png')}}'   height='16'>"
                                                   value="en"></option>
                                       </select>
                                       <input type="text" class="form-control" name="contact_message_ar" value="{{$site->contact_message_ar}}"
                                              id="contact_message_ar">
                                       <input type="text" class="form-control" name="contact_message" value="{{$site->contact_message}}"
                                              id="contact_message" hidden>

                                   </div>
                               </div>

                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-6">
                                   <label for="select_title">{{__('About')}}</label>
                                   <div class="input-group">
                                       <select class="selectpicker form-control" id="select_about" data-width="fit">
                                           <option data-content="<img src='{{asset('images/eg.png')}}'  height='16'>"
                                                   value="ar"></option>
                                           <option data-content="<img src='{{asset('images/us.png')}}'   height='16'>"
                                                   value="en"></option>
                                       </select>
                                       <input type="text" class="form-control" name="about_ar" value="{{$site->about_ar}}"
                                              id="about_ar">
                                       <input type="text" class="form-control" name="about" value="{{$site->about}}"
                                              id="about" hidden>

                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('site slogan')}}</label>
                                       <input type="text" class="form-control" value="{{$site->slogan}}" name="slogan">
                                   </div>
                               </div>

                           </div>
                       </div>
                   </div>
                    <hr style="width: 98%">
                   <div>
                       <h2 class="mb-3">{{__('Social Media Info')}}</h2>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('Facebook')}}</label>
                                       <input type="text" class="form-control" value="{{$site->facebook}}" name="facebook">
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('linkedin')}}</label>
                                       <input type="text" class="form-control" value="{{$site->linkedin}}" name="linkedin">
                                   </div>
                               </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('instagram')}}</label>
                                       <input type="text" class="form-control" value="{{$site->instagram}}" name="instagram">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('youtube')}}</label>
                                       <input type="text" class="form-control" value="{{$site->youtube}}" name="youtube">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('twitter')}}</label>
                                       <input type="text" class="form-control" value="{{$site->twitter}}" name="twitter">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('telegram')}}</label>
                                       <input type="text" class="form-control" value="{{$site->telegram}}" name="telegram">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="exampleFormControlInput1">{{__('tiktok')}}</label>
                                       <input type="text" class="form-control" value="{{$site->tiktok}}" name="tiktok">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <hr style="width: 98%">
                   </div>
                    <div>
                        <h2 class="mb-3">{{__('Financials')}}</h2>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="form-group col-6">
                                   <label for="default_currancy">{{__('Default Currency')}}</label>
                                   <select name="default_currancy" class="form-control select2" id="default_currency">
                                       <option value="$" <?php if ($site->default_currancy == '$') echo 'selected' ?>>$</option>
                                       <option value="EGP" <?php if ($site->default_currancy == 'EGP') echo 'selected' ?>>{{__('EGP')}}</option>
                                   </select>

                               </div>


                               <div class="form-group col-6">
                                   <label for="convert_to_usd">{{__('Convert rate to USD')}} $</label>
                                   <input type="number" min=0 step="any" id="convert_to_usd" class="form-control" name="convert_to_usd" value="<?= $site->convert_to_usd ?>">
                               </div>
                           </div>
                       </div>

                      <div class="col-md-12">
                          <div class="row">
                              <div class="form-group col-6">
                                  <label for="cashback_percentage">{{__('Cashback Percentage')}}</label>
                                  <input type="number" min="0" step="0.25" max="100" id="cashback_percentage" class="form-control" name="cashback_percentage" value="<?= $site->cashback_percentage ?>">
                              </div>

                              <div class="form-group col-6">
                                  <label for="minimum_order_cashback">{{__('Cashback minimum order limit')}}</label>
                                  <input type="number" min="1" step="1" max="10000" id="minimum_order_cashback" class="form-control" name="minimum_order_cashback" value="<?= $site->minimum_order_cashback ?>">
                              </div>

                          </div>
                      </div>
                       <div class="col-md-12">
                           <div class="row">
                               <div class="form-group col-6">
                                   <label for="offer_amount">{{__('Offer Amount')}}</label>
                                   <input type="number" min="0" max="50000" id="offer_amount"
                                          class="form-control" name="offer_amount" value="<?= $site->offer_amount ?>">
                               </div>

                               <div class="form-group col-6">
                                   <label for="offer_deduction">{{__('Offer deduction')}} (%)</label>
                                   <input type="number" min="0" max="100" id="offer_deduction"
                                          class="form-control" name="offer_deduction" value="<?= $site->offer_deduction ?>">
                               </div>
                           </div>
                       </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="offer_applied_on">{{__('Offer Applied On')}}</label>
                                    <select id="offer_applied_on" class="form-control select2" name="offer_applied_on">
                                        <option value="both" <?php if ($site->offer_applied_on == 'both') { ?> selected="selected" <?php } ?>>{{__('Both')}}</option>
                                        <option value="new" <?php if ($site->offer_applied_on == 'new') { ?> selected="selected" <?php } ?>>{{__('New Users')}}</option>
                                        <option value="exist" <?php if ($site->offer_applied_on == 'exist') { ?> selected="selected" <?php } ?>>{{__('Existing Users')}}</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="offer_start_at">{{__('Offer start date')}}</label>
                                    <input type="text" id="offer_start_at" class="form-control"
                                           name="offer_start_at" value="{{$site->offer_start_at}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="offer_end_at">{{__('Offer end date')}}</label>
                            <input type="text" id="offer_end_at" class="form-control"
                                   name="offer_end_at" value="{{$site->offer_end_at}}">
                        </div>

                    </div>

                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-primary btn-lg">{{__('Update')}}</button>
                    <a href="{{route('settings.edit')}}" class="btn btn-warning btn-lg">{{__('Cancel')}}</a>
                </div>

            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#default_currency").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
            })

            $("#offer_applied_on").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
            })

            let isRtl = $("html").attr("dir") === "rtl"
            let direction = isRtl ? "bottom-left" : "bottom-right"
            $('#offer_start_at').datepicker({
                pickerPosition: direction, // Set dropdown direction
                todayHighlight: true
            });
            $('#offer_end_at').datepicker({
                pickerPosition: direction, // Set dropdown direction
                todayHighlight: true
            });


            $(document).on('change', '#select_message', function (e) {
                e.preventDefault();
                if ($("#select_message option:selected").val() == 'ar') {
                    $("#contact_message").attr('hidden', true)
                    $("#contact_message_ar").attr('hidden', false)
                } else {
                    $("#contact_message_ar").attr('hidden', true)
                    $("#contact_message").attr('hidden', false)
                }
            })

            $(document).on('change', '#select_about', function (e) {
                e.preventDefault();
                if ($("#select_about option:selected").val() == 'ar') {
                    $("#about").attr('hidden', true)
                    $("#about_ar").attr('hidden', false)
                } else {
                    $("#about_ar").attr('hidden', true)
                    $("#about").attr('hidden', false)
                }
            })


            $("#update_settings").validate({
                ignore: 'input[type=hidden]',
                rules: {

                    site: 'required',
                    name: 'required',
                    link: 'required',
                },
                messages: {

                    name: '{{__('site name is required')}}',
                    link: '{{__('site link is required')}}',
                    site: '{{__('site type is required')}}',
                },
                errorPlacement: function (error, element) {
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element.parent());
                    }
                }
            });


        })
        function siteImagePreview(event) {
            if (event.target.files.length > 0) {
                $(".site-image").attr('hidden', false)
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.querySelector("#site_image");
                preview.src = src;
                $("#site_img").attr('href', src)

            }
        }
    </script>
@endpush
