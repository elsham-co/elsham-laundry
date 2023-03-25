@extends('core::layouts.app')

@section('title')
    {{__('Edit Samples Order')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Samples_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-rtl.min.css')}}"> --}}
    
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('Edit Samples Order')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('SamplesOrder.update',$Sample_order->id)}}" method="POST" id="update_SamplesOrder" name="update_SamplesOrder" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_order->samplecode}}"  id="samplecode" name="samplecode">
                                    <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                    <input type="text" class="form-control form-control-lg" value="{{$Sample_order->data}}"  id="customer_code" name="customer_code">
                                <label for="customer_code">{{__('Customer Name')}} :</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                                <input type="text" class="form-control form-control-lg" value="{{$Sample_order->fabric}}"  id="fabrics_code" name="fabrics_code">
                            <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                        </div>
                    </div>
                </div>

<div class="col-md-2">
    <div class="form-group">
        <div class="float-label float-label-lg">
            <input type="number" min="0" class="form-control form-control-lg"  value="{{$Sample_order->nopieces}}" id="nopieces" name="nopieces">
        <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
    </div>
</div>
</div>


@if(!empty($Sample_order->Samplecreation->lab_receiptdate))
<div class="form-group">
        <table  class="table table-bordered" id="view_table">
            <thead>
                <tr style="text-align:center">
                    <th>{{__('Colors Name')}}</th>
                    <th>{{__('Fashion Name')}}</th>
                    <th>{{__('Samples Order Notes')}}</th>
                </tr>
            </thead>
            <tbody>
               
                <tr id="view"  style="text-align:center">
                    <td>
                        @if(!empty($Sample_order->colors_code))
                        @foreach (json_decode($Sample_order->colors_code) as $singleColor)
                        <span class="badge badge-secondary"> {{ $singleColor }}</span>
                    @endforeach
                    @endif
                    </td>
                    <td>
                    @if(!empty($Sample_order->fashion_code)) 
                    @foreach (json_decode($Sample_order->fashion_code) as $singleTag)
                    <span class="badge badge-secondary"> {{ $singleTag }}</span>
                @endforeach
                @endif
                    </td>
                    <td>
                        {{ $Sample_order->samplesnotes }}
                 </td>
                </tr>
            </tbody>
        </table>
        </div>
@else
 <div class="col-md-12" id="Colorsselect">
    <div class="form-group">
<div class="float-label float-label-lg">
    <select  class="form-select select2 area" id="colSelect" name="colors_code[]" th:field="*{brokerCategoryCodes}" multiple>
         @foreach($ColorsName as $singleColor)
         @if(!empty($Sample_order->colors_code)) 
         <option value="{{ $singleColor->colorname }}" {{ (in_array($singleColor->colorname, json_decode($Sample_order->colors_code))) ? 'selected' : '' }}>{{  $singleColor->colorcode." - ".$singleColor->colorname}}</option>
         @else
         <option value="{{ $singleColor->colorname }}">{{  $singleColor->colorcode." - ".$singleColor->colorname}}</option>
         @endif
         @endforeach
       </select>
<label for="colSelect">{{__('Colors Name')}} :</label>
</div>
</div>
</div>

<!-- Options -->
<div class="col-md-12" id="Fashionselect">
    <div class="form-group">
<div class="float-label float-label-lg">
    <select  class="form-select select2 area" id="fasSelect" name="fashion_code[]" th:field="*{brokerCategoryCodes}" multiple>
   @foreach($FashionsName as $fasCategory)
   @if(!empty($Sample_order->fashion_code)) 
   <option value="{{ $fasCategory->fashionname }}" {{ (in_array($fasCategory->fashionname, json_decode($Sample_order->fashion_code))) ? 'selected' : '' }}>{{  $fasCategory->fashioncode." - ".$fasCategory->fashionname}}</option>
   @else
   <option value="{{ $fasCategory->fashionname }}">{{  $fasCategory->fashioncode." - ".$fasCategory->fashionname}}</option>
   @endif
   @endforeach

       </select>

<label for="fabSelect">{{__('Fashion Name')}} :</label>
</div>
</div>
</div>


                            <div class="form-group" >
                                <div class="float-label float-label-lg">
                                   
                                <textarea rows="3" cols="30" id="samplesnotes" class="form-control form-control-lg" name="samplesnotes" placeholder="{{__('Please... Enter The Samples Order Notes')}}">
                                    {{$Sample_order->samplesnotes}}
                                </textarea>
                              
                                <label for="samplesnotes">{{__('Samples Order Notes')}} :</label>
                            </div>
                        </div>
@endif



                        </div>
                    </div>
                  
                <div class="text-center mt-5">
                    @if(!empty($Sample_order->Samplecreation->lab_receiptdate))
                    <a href="{{route('SamplesOrder.index')}}" class="btn btn-danger btn-lg">{{__('Back')}}</a>
                    @else
                    <button class="btn btn-success btn-lg">{{__('Update')}}</button>
                    <a href="{{route('SamplesOrder.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                    @endif
                </div>
            </form>
            <div class="col"></div>
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet-->

        @endsection

{{-- =============================================================================================================== --}}
        @push('js')
        {{-- <script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script> --}}
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('#samplecode').prop('readonly', true); //  
                $('#customer_code').prop('readonly', true); //  
                $('#fabrics_code').prop('readonly', true); //  
                $('#ReceiptDate').prop('readonly', true); //  
                $('#lab_receiptdate').prop('readonly', true); //  
                $('#fromlab_date').prop('readonly', true); //  
                $('#DeliveryDate').prop('readonly', true); // 
                $('#Deliveredto').prop('readonly', true); // 
                $("#create_SamplesOrder").attr("autocomplete", "off");


$('#colSelect').select2({
    placeholder: "{{__('-- Select Colors --')}}",
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
//   theme: "bootstrap-5",
//   tags: true,
});
$('#fasSelect').select2({
    placeholder: "{{__('-- Select Fashions --')}}",
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
//   theme: "bootstrap-5",
//   tags: true,
});

            $("#colSelect").validate().settings.ignore=[];
            $("#fasSelect").validate().settings.ignore=[];

            //    $('#bill_icon').hide();  // hide button

                $("#create_SamplesOrder").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        samplecode:'required',
                        customer_code:'required',
                        fabrics_code:'required',
                        "colors_code[]":'required',
                        samplesnotes: {maxlength:127}
                    },
                    messages:{
                        samplecode:'{{__('SamplesOrder ID is Required Field...Please SamplesOrder ID')}}',
                        customer_code:'{{__('Customer Name is Required Field...Please Add Customer Name')}}',
                        fabrics_code:'{{__('Fabric Name is Required Field...Please Add Fabric Name')}}',
                        "colors_code[]":'{{__('Color Name is Required Field...Please Add Color Name')}}',
                        samplesnotes:{
                            maxlength: '{{__('Sorry...it is allowed to enter 127 characters in Samples Order Notes')}}'
                        }
                        

                        
                    },
                    errorElement: "div",
          errorPlacement: function ( error, element ) {
            if (element.hasClass('select2') && element.next('.select2-container').length) {
                  error.addClass( "invalid-feedback" );
                  error.insertAfter(element.next('.select2-container'));
              }else{
            error.addClass( "invalid-feedback" );
            error.insertAfter( element );
              }
        },
      highlight: function(element) {
        $(element).removeClass('is-valid').addClass('is-invalid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      }
                }) 
// =================================================================================================
// =================================================================================================
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}

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
// stop paste in input text (fabricName)
$(":input").on("paste", function (e) {
    e.preventDefault();
});
// ===================================================================================


});

    </script>
@endpush