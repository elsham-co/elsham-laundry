
@extends('core::layouts.app')

@section('title')
    {{__('Create Duplicate Samples')}}
@endsection
@push('css')
{{-- new --}}

<link rel="stylesheet" href="{{asset('cssNEW/bootstrap-duallistboxamr.css')}}">

{{-- new --}}
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
    <style>
        .transfer-btn {
  margin-bottom: 100
        }
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }

    </style>
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('Create Duplicate Samples')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('SamplesReCreate.update',$Sample_inlab->id)}}" method="POST" id="update_Samples" name="update_Samples" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <!-- Options -->
                    <div class="col-md-6" id="custselect">
                        <div class="form-group">
                    <div class="float-label float-label-lg">
                        <select  class="form-select select2 area" id="multiSelect" name="customer_code" th:field="*{brokerCategoryCodes}">
                       <option value="" disabled selected>{{__('-- Select Customer --')}}</option> 
                               <hr>
                               <optgroup >
                                <option  value="">
                                <a href="#"><img src="{{asset('images/plus-circle.svg')}}" alt="" width="20" height="20">
                                   {{__('Add New Customer')}}</a>
                                </option>
                                </optgroup>
                               <hr>
                               @foreach($CustomerName1 as $CustomerName)
                               <option id="" value="{{$CustomerName->customers_code}}"
                                @if($CustomerName->customers_code == $Sample_inlab->customer_code)
                                                selected
                                            @endif
                                > {{ $CustomerName->customers_code." - ".$CustomerName->customers_name}} </option>
                             @endforeach
                           </select>
                  <label for="multiSelect">{{__('Customer Name')}} :</label>
                 </div>
                </div>
              </div>

                <!-- Options -->
       <div class="col-md-4" id="fabricsselect">
        <div class="form-group">
    <div class="float-label float-label-lg">
        <select  class="form-select select2 area" id="fabSelect" name="fabrics_code" th:field="*{brokerCategoryCodes}">
       <option value="" disabled selected>{{__('-- Select Fabric --')}}</option> 
       
               @foreach($FabricName as $singleName)
               <option id="" value="{{$singleName->fabric_code}}"
                @if($singleName->fabric_code == $Sample_inlab->fabrics_code)
                                                selected
                                            @endif
                > {{ $singleName->fabric_code." - ".$singleName->fabricName}} </option>
             @endforeach
           </select>
  <label for="fabSelect">{{__('Fabrics Name')}} :</label>
 </div>
</div>
</div>

<div class="col-md-2">
    <div class="form-group">
        <div class="float-label float-label-lg">
            <input type="number"  min="0" class="form-control form-control-lg" value="{{$Sample_inlab->Sampleorder}}"  id="nopieces" name="nopieces">
        <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
    </div>
</div>
</div>

<div class="col-md-4">
  <div class="form-group">
      <div class="float-label float-label-lg">
          <input type="text" class="form-control form-control-lg" value="{{$Sample_inlab->technical_description}}"  id="technical_description" name="technical_description">
      <label for="technical_description">{{__('Technical Description')}} :</label>
  </div>
</div>
</div> 

<!-- Options -->
    <div class="col-md-4">
        <div class="form-group">
    <div class="float-label float-label-lg">
        <select  class="form-select select2 area" id="stage_type" name="stage_type" th:field="*{brokerCategoryCodes}">
       <option value="" disabled selected></option> 
       <option value="colors" @if (old('stage_type') == "colors") {{ 'selected' }} @endif>{{__('Colors')}}</option>
       <option value="fashion" @if (old('stage_type') == "fashion") {{ 'selected' }} @endif>{{__('Fashion')}}</option>
           </select>
   
  <label for="stage_type">{{__('Stage Type')}} :</label>
 </div>
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

        {{-- <div class="container"> --}}
            <div class="row" >
              <div class="col-md-5" >
                <div class="form-group">
                    
                  <label for="multiSelect1">{{__('Available Stages')}}</label>
                  <input type="text" class="form-control" id="searchInput" placeholder={{__('Search By Name Or Code')}} >
                  <select multiple class="form-control" id="multiSelect1" size="10" style="font-size:16px;font-weight: bold;">
 
                    @foreach($Sample_inlab->Sample_info as $singleName)
               <option id="" value="{{$singleName->sample_code." - ".$singleName->stage_name}}"

                > {{ $Sample_inlab->samplecode." - ".$singleName->stage_name}} </option>
             @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                {{-- <div class="form-group"> --}}
                <div class="d-flex flex-column justify-content-flex-end align-items-center">
                  <button type="button" class="btn btn-outline-primary transfer-btn btn-lg" id="transferButton">&gt;</button>
                  <button type="button" class="btn btn-outline-primary transfer-btn btn-lg" id="transferAllButton">&gt;&gt;</button>
                  <button type="button" class="btn btn-outline-primary transfer-btn btn-lg" id="removeButton">&lt;</button>
                  <button type="button" class="btn btn-outline-primary transfer-btn btn-lg" id="removeAllButton">&lt;&lt;</button>
                </div>
                {{-- </div> --}}
              </div>
          
              <div class="col-md-5">
                <div class="form-group">
                  <label for="multiSelect2">{{__('Selected Stages')}}</label>
                  <select multiple class="form-control" id="multiSelect2" size="12" name="multiSelect2[]" 
                  style="font-size:16px;font-weight: bold;">
                </select>
                <div class="col-sm-12 d-flex">
                  <button class="btn btn-outline-primary mt-2 fa fa-chevron-up"  id="up"></button>
                  <button class="btn btn-outline-primary mt-2 fa fa-chevron-down"  id="down"></button>
                </div>
                </div>
              </div>

            </div>
     
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

                        @push('js')
                        <script type="text/javascript" src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
                        <script>

    $('#multiSelect').select2({
    placeholder: "{{__('-- Select Fashions --')}}",
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
});

$('#fabSelect').select2({
    placeholder: "{{__('-- Select Fashions --')}}",
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,
});
$('#stage_type').select2({
    placeholder: "{{__('-- Select Stage Type --')}}",
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



$(document).ready(function() {

  $('#classification').bootstrapToggle();

  $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#multiSelect1 option").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $("#multiSelect1, #multiSelect2").on("click", "option", function() {
    $(this).toggleClass("selected");
  });

  $("#transferButton").on("click", function() {
    // $("#multiSelect1 .selected").clone().appendTo("#multiSelect2");
    // $("#multiSelect1 .selected").remove();
    // $("#multiSelect2").scrollTop(0);
    // $("#multiSelect1 option").sort(function(a, b) {
    //   return a.text.toUpperCase().localeCompare(b.text.toUpperCase());
    // }).appendTo("#multiSelect1");

    $('#multiSelect1 option:selected').each(function () {
        $("<option/>").
        val($(this).val()).
        text($(this).text()).
        appendTo("#multiSelect2");
    });

    $("#multiSelect1 .selected").remove();

  });

  $("#transferAllButton").on("click", function() {
    $("#multiSelect1 option").clone().appendTo("#multiSelect2");
    $("#multiSelect1 option").remove();
    $("#multiSelect2").scrollTop(0);
    $("#multiSelect1 option").sort(function(a, b) {
      return a.text.toUpperCase().localeCompare(b.text.toUpperCase());
    }).appendTo("#multiSelect1");
  });

  $("#removeButton").on("click", function() {
  //   $("#multiSelect2 .selected").clone().appendTo("#multiSelect1");
  //   $("#multiSelect2 .selected").remove();
  //   $("#multiSelect1").scrollTop(0);
  //   $("#multiSelect1 option").sort(function(a, b) {
  //     return a.text.toUpperCase().localeCompare(b.text.toUpperCase());
  //   }).appendTo("#multiSelect1");

$('#multiSelect2 option:selected').each(function () {
        $("<option/>").
        val($(this).val()).
        text($(this).text()).
        appendTo("#multiSelect1");
    });
    $('#multiSelect2 option:selected').remove();

  });



  
  $("#removeAllButton").on("click", function() {
    $("#multiSelect2 option").clone().appendTo("#multiSelect1");
    $("#multiSelect2 option").remove();
    $("#multiSelect1").scrollTop(0);
    $("#multiSelect1 option").sort(function(a, b) {
      return a.text.toUpperCase().localeCompare(b.text.toUpperCase());
    }).appendTo("#multiSelect1");
    
  });

$("#up").on("click", function(e) {
  e.preventDefault();
var select = document.getElementById("multiSelect2");
  var selectedOption = select.options[select.selectedIndex];
  if (selectedOption) {
    var previousOption = selectedOption.previousElementSibling;
    if (previousOption) {
      select.insertBefore(selectedOption, previousOption);
    }
  }

    });

$("#down").on("click", function(e) {
  e.preventDefault();
// var select = document.getElementById("multiSelect2");
//   var selectedOption = select.options[select.selectedIndex];
//   if (selectedOption) {
//     var nextOption = selectedOption.nextElementSibling;
//     if (nextOption) {
//       select.insertBefore(nextOption, selectedOption);
//     }
//   }
var select1 = $('#select1 option:selected').text();
  var select2 = $('#select2 option:selected').text();
  var joinedText = select1 + ' ' + select2;
  // $('#joined').text(joinedText);
  $('#select2 option:selected').text(joinedText)

  });


  $('#stage_type').on('change', function() {
                var id = $(this).val();
                // alert(id);
                if (id) {
                    $.ajax({
                        url: '{{ route("getOptions", ":id") }}'.replace(':id', id),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#multiSelect1').empty();
                            $.each(data, function(key, value) {
                              if($('#stage_type option:selected').val()==='colors'){
                                $('#multiSelect1').append('<option value="' + value + '">' + '{{__('Colors')}}' + " - " + value + '</option>');
                              }
                              else{
                                $('#multiSelect1').append('<option value="' + value + '">' + '{{__('Fashion')}}'+ " - " + value + '</option>');
                              }
                                // alert(value);
                            });
                        }
                    });
                } else {
                    $('#multiSelect1').empty();
                }
            });

     $("#update_Samples").on("submit",function(eve){

            $("select#multiSelect2").find("option").prop("selected", true);
            $(this).submit();
        })


});



</script>

@endpush