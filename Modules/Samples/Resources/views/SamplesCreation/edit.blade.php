
@extends('core::layouts.app')

@section('title')
    {{__('Create Samples')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap-5-theme.rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/switchery.css')}}">
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }
        
      </style>
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('Create Samples')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('SamplesCreation.update',$Sample_inlab->id)}}" method="POST" id="update_Samples" name="update_Samples" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_inlab->samplecode}}"  id="samplecode" name="samplecode">
                                    <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                                </div>
                            </div>
                        </div>
                  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="float-label float-label-lg">
                                            <input type="text" class="form-control form-control-lg" value="{{$Sample_inlab->data}}"  id="customer_code" name="customer_code">
                                        <label for="customer_code">{{__('Customer Name')}} :</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_inlab->fabric}}"  id="fabrics_code" name="fabrics_code">
                                    <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                    <input type="number" min="0" class="form-control form-control-lg" value="{{$Sample_inlab->Sampleorder->nopieces}}"  id="nopieces" name="nopieces">
                                <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="float-label float-label-lg">
                                <input type="text" class="form-control form-control-lg" value="{{$Sample_inlab->Sampleorder->colors_code}}"  id="colors_code" name="colors_code">
                            <label for="colors_code">{{__('Colors Name')}} :</label>
                        </div>
                    </div>
                </div> 

            <div class="form-group" >
                <div class="float-label float-label-lg">
                   
                <textarea rows="3" cols="30" id="fashion_code" class="form-control form-control-lg" name="fashion_code">
                    {{$Sample_inlab->Sampleorder->fashion_code}}
                </textarea>
                <label for="fashion_code">{{__('Fashion Name')}} :</label>
            </div>
        </div> 

         <div class="form-group" >
                <div class="float-label float-label-lg">
                   
                <textarea rows="3" cols="30" id="samplesnotes" class="form-control form-control-lg" name="samplesnotes" placeholder="{{__('Please... Enter The Samples Order Notes')}}">
                    {{$Sample_inlab->Sampleorder->samplesnotes}}
                </textarea>
                <label for="samplesnotes">{{__('Samples Order Notes')}} :</label>
            </div>
        </div>

       <div class="col-md-4">
            <div class="form-group">
                <label for="classification">{{__('Classification')}} :
                <input id="classification" data-toggle="toggle" data-on={{__('Sample')}} data-off={{__('Cartel')}}
                 type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                 name="classification"
                 {{-- {{$Sample_inlab->classification == 1 ?'checked':''}} --}}
                 {{$Sample_inlab->classification == 1 ?'checked':''}} checked>
            </label>
            </div> 
        </div>   

        
        <!-- Options -->
       {{-- <div class="col-md-4">
        <div class="form-group">
    <div class="float-label float-label-lg">
        <select  class="form-select select2 area" id="operation_type" name="operation_type" th:field="*{brokerCategoryCodes}">
       <option value="" disabled selected></option> 
       <option value="dyeing" @if (old('operation_type') == "dyeing") {{ 'selected' }} @endif>{{__('Dyeing')}}</option>
       <option value="dyeing+fashion" @if (old('operation_type') == "dyeing+fashion") {{ 'selected' }} @endif>{{__('Dyeing + Fashion')}}</option>
       <option value="laundry" @if (old('operation_type') == "laundry") {{ 'selected' }} @endif>{{__('laundry')}}</option>
       <option value="laundry+fashion" @if (old('operation_type') == "laundry+fashion") {{ 'selected' }} @endif>{{__('Laundry + Fashion')}}</option>
           </select>
   
  <label for="operation_type">{{__('Operation Type')}} :</label>
 </div>
</div>
</div>  --}}

<div class="col-md-4">
    <div class="form-group">
        <div class="float-label float-label-lg">
            <input type="text" class="form-control form-control-lg" value=""  id="technical_description" name="technical_description">
        <label for="technical_description">{{__('Technical Description')}} :</label>
    </div>
</div>
</div> 
                            {{-- <div class="form-group" >
                                <div class="float-label float-label-lg">
                                <textarea rows="3" cols="30" id="samplesnotes" class="form-control form-control-lg" name="samplesnotes" placeholder="{{__('Please... Enter The Samples Order Notes')}}"></textarea>
                                <label for="samplesnotes">{{__('Samples Order Notes')}} :</label>
                            </div>
                        </div> --}}
                
                        
                   
    
{{-- ====================================================================================================== --}}
<div class="card"> {{--start class card--}}
    <div class="card-header" style="font-size: 16px;font-weight: bold;">
        {{__('Sample Phases')}}  
    </div>
<div class="card-body">  {{--start class card-body --}}

         <table class="table" id="products_table">
            <thead>
                <tr style="text-align:center">
                    <th>{{__('Phase Name')}}</th>
                    <th>{{__('Phase Note')}}</th>
                    <th>
                        {{-- {{__('Actions')}} --}}
                       
                        <button id="add_row" class="btn btn-secondary add_row">
                            <span class="fa fa-plus"></span>
                        </button>
                    </th> 
                </tr>
            </thead>
            <tbody>
               
                <tr id="product0"  style="text-align:center">
                    <td>
                        <select name="phase_name[]"  id="phase_name" class="form-control select2" >
                            <option value="">-- {{__('Select Phase Name')}} --</option>
                            <optgroup label={{__('Colors')}}>
                                @foreach($ColorsName as $singleColor)
                                {{-- <option id="" value="{{$singleColor->colorname}}"> {{ $singleColor->colorcode." - ".$singleColor->colorname}} </option> --}}
                                <option value="{{ $singleColor->colorname }}" {{ (collect(old('phase_name'))->contains($singleColor->colorname)) ? 'selected':'' }}>
                                    {{ $singleColor->colorcode." - ".$singleColor->colorname}}</option>

                               
                                @endforeach

                                </optgroup>
                                <optgroup label={{__('Fashion')}}>
                                    @foreach($FashionsName as $singleFashion)
                                    {{-- <option id="" value="{{$singleFashion->fashionname}}"> {{ $singleFashion->fashioncode." - ".$singleFashion->fashionname}} </option> --}}
                                    <option value="{{ $singleFashion->fashionname }}" {{ (collect(old('phase_name'))->contains($singleFashion->fashionname)) ? 'selected':'' }}>
                                        {{ $singleFashion->fashioncode." - ".$singleFashion->fashionname}}</option>
                                  
                                    @endforeach
                                    </optgroup>
                            </select>

                    </td>
                    <td>
                        <input type="text" name="stage_notes[]" class="form-control stage_notes" value="" id="stage_notes"/>
                    </td>
                    <td>
                   
                        <button id='delete_row' class="pull-right btn btn-danger remove">
                            <span class="fa fa-minus"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

</div> {{--end class card-body --}}
 </div> {{--end class card--}}

</div>
</div>
                <div class="text-center mt-5">
                    <button class="btn btn-success btn-lg">{{__('Create')}}</button>
                    <a href="{{route('inlabSample.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
            <div class="col"></div>
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet-->

        @endsection

{{-- =============================================================================================================== --}}
        @push('js')
        <script type="text/javascript" src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
       <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        <script src="{{asset('js/switchery.js')}}"></script>
        <script src="{{asset('js/uppy.min.js')}}"></script>
        
        <script>
            $(document).ready(function () {


             $('#classification').bootstrapToggle();

                $('#samplecode').prop('readonly', true); //  
                $("#customer_code ").prop('readonly', true);
                $("#fabrics_code").prop('readonly', true);
                $("#nopieces").prop('readonly', true);
                $('#colors_code').prop('readonly', true); //  
                $('#fashion_code').prop('readonly', true); //  
                $('#samplesnotes').prop('readonly', true); //  
                
                $("#update_Samples").attr("autocomplete", "off");
              

//             $('#operation_type').select2({
//                 placeholder: "{{__('-- Operation Type --')}}",
//                 dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
//                 dropdownAutoWidth: true,
// });
$('#phase_name').select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
});


            // $("#operation_type").validate().settings.ignore=[];
            $("#phase_name").validate().settings.ignore=[];

// Find all existing Select2 instances
$('.select2-hidden-accessible')
    // Attach event handler with some delay, waiting for the search field to be set up
    .on('select2:open', event => setTimeout(
        // Trigger focus using DOM API
        () => $(event.target).data('select2').dropdown.$search.get(0).focus(),
        10));


                $("#update_Samples").validate({
                    ignore: 'input[type=hidden]',
                    rules:{
                        // operation_type:'required',
                        technical_description: {maxlength:5},
                        "phase_name[]":'required',
                        "stage_notes[]": {maxlength:20}
                    },
                    messages:{
                        // operation_type:'{{__('Operation Type is Required Field...Please Select Operation Type')}}',
                        technical_description:{
                            // required: '{{__('Technical Description is Required Field...Please Add Technical Description')}}',
                           maxlength: '{{__('Sorry...it is allowed to enter 25 characters in Technical Description')}}'
                        },
                        "phase_name[]":'{{__('Phase Name is Required Field...Please Add Phase Name')}}',
                        "stage_notes[]":{
                            maxlength: '{{__('Sorry...it is allowed to enter 20 characters in Phase Note')}}'
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
// =========================================================================================================
$('.select3').change(function() {
showLabel()

});
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
// ==================================================================================
});
$(".add_row").click(function(e){
      e.preventDefault();
 addrow();
$(".select2").select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
});

// Find all existing Select2 instances
$('.select2-hidden-accessible')
    // Attach event handler with some delay, waiting for the search field to be set up
    .on('select2:open', event => setTimeout(
        // Trigger focus using DOM API
        () => $(event.target).data('select2').dropdown.$search.get(0).focus(),
        10));


showLabel()
    });
// =========================================================================================
function showLabel(e){ 
// show option group label name on text
    var gameConsoleOptions = $(".quantities");

    $(".select2").on("change", function () {
        var label = $(this).find("option:selected").closest('optgroup').prop('label');
        $(".quantities").val(label); 
    });
}

function addrow(){
    var tr ='<tr id="product0" style="text-align:center">'+
             '<td>'+
                '<select name="phase_name[]"  id="phase_name" class="form-control select2" >'+
                    '<option value="">-- {{__('Select Phase Name')}} --</option>'+
                    '<optgroup label={{__('Colors')}}>'+
                        ' @foreach($ColorsName as $singleColor)'+
                        // '<option id="" value="{{$singleColor->colorname}}"> {{ $singleColor->colorcode." - ".$singleColor->colorname}} </option>'+
                 '<option value="{{ $singleColor->colorname }}" {{ (collect(old('phase_name'))->contains($singleColor->colorname)) ? 'selected':'' }}>'+
                                    '{{ $singleColor->colorcode." - ".$singleColor->colorname}}</option>'+
                        
                        '@endforeach'+
                        '</optgroup>'+
                        '<optgroup label={{__('Fashion')}}>'+
                            '@foreach($FashionsName as $singleFashion)'+
                            // '<option id="" value="{{$singleFashion->fashionname}}"> {{ $singleFashion->fashioncode." - ".$singleFashion->fashionname}} </option>'+
                 '<option value="{{ $singleFashion->fashionname }}" {{ (collect(old('phase_name'))->contains($singleFashion->fashionname)) ? 'selected':'' }}>'+
                                        '{{ $singleFashion->fashioncode." - ".$singleFashion->fashionname}}</option>'+
                            '@endforeach'+
                            '</optgroup>'+
                    '</select>'+
            '</td>'+
               '<td>'+
                        '<input type="text" name="stage_notes[]" class="form-control stage_notes" value="" id="stage_notes"/>'+
                    '</td>'+
            // '<td>'+
            //             '<input type="text" name="quantities[]" class="form-control quantities" value="1" id="quantities"/>'+
            //         '</td>'+
                    '<td>'+
                        '<button class="pull-right btn btn-danger remove">'+
                            '<span class="fa fa-minus"></span>'+
                        '</button>'+
                    '</td>'+
        '</tr>';
   
        $('tbody').append(tr);
};


$('tbody').on('click','.remove',function(){
$(this).parent().parent().remove();
});

    </script>
@endpush