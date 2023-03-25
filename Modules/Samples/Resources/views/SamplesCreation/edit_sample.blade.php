@extends('core::layouts.app')

@section('title')
    {{__('Edit Samples Phases')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/customers_create.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap-5-theme.rtl.min.css')}}">

@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-vial" >
            {{__('Edit Samples Phases')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
            <div class="portlet-body d-flex align-items-center justify-content-center">
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->samplecode}}"  id="samplecode" name="samplecode">
                                    <label for="samplecode">{{__('SamplesOrder ID')}} :</label>
                                </div>
                            </div>
                        </div>
                  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="float-label float-label-lg">
                                            <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->data}}"  id="customer_code" name="customer_code">
                                        <label for="customer_code">{{__('Customer Name')}} :</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="float-label float-label-lg">
                                        <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->fabric}}"  id="fabrics_code" name="fabrics_code">
                                    <label for="fabrics_code">{{__('Fabrics Name')}} :</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="float-label float-label-lg">
                                    <input type="number" min="0" class="form-control form-control-lg" value="{{$Sample_bank->Sampleorder}}"  id="nopieces" name="nopieces">
                                <label for="nopieces">{{__('Fabrics Pieces')}} :</label>
                            </div>
                        </div>
                    </div> 

        <div class="col-md-2">
            <div class="form-group">
                <div class="float-label float-label-lg">
                    <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->classification}}"  id="classification" name="classification">
                <label for="classification">{{__('Classification')}} :</label>
            </div>
        </div>
    </div>

        <!-- Options -->
       {{-- <div class="col-md-4">
       <div class="form-group">
     <div class="float-label float-label-lg">
           @if($Sample_bank->operation_type == 'dyeing')
           <input type="text" value={{__('Dyeing')}} class="form-control form-control-lg" id="op_type" name="op_type">
           @elseif($Sample_bank->operation_type == 'dyeing+fashion')
           <input type="text" class="form-control form-control" value="{{__('Dyeing + Fashion')}}"  id="op_type" name="op_type">
           @elseif($Sample_bank->operation_type == 'laundry')
           <input type="text" class="form-control form-control" value="{{__('laundry')}}"  id="op_type" name="op_type">
           @elseif($Sample_bank->operation_type == 'laundry+fashion')
           <input type="text" class="form-control form-control" value="{{__('Laundry + Fashion')}}"  id="op_type" name="op_type">
        @endif
           <label for="operation_type">{{__('Operation Type')}} :</label>
 </div>
</div> 
</div>  --}}

<div class="col-md-4">
    <div class="form-group">
        <div class="float-label float-label-lg">
            <input type="text" class="form-control form-control-lg" value="{{$Sample_bank->technical_description}}"  id="technical_description" name="technical_description">
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
                    <th>#</th>
                    <th>{{__('Phase Name')}}</th>
                    <th>{{__('Phase Note')}}</th>
                    <th>{{__('Actions')}}</th>

                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($Sample_bank->Sample_info) as $key=> $StageName)
                <tr id="product0"  style="text-align:center">
                    <th scope="row">{{$key+1}}</th>
                   
                    <td>
                           {{$StageName->stage_name}}
                    </td>

                    <td>
                       {{$StageName->stage_notes}}
                    </td>
                    <td>

                        <button type="button" class="pull-right btn btn-primary btn-icon mr-1 ml-1" data-toggle="modal" data-target-id="{{ $StageName->id }}" 
                            data-target-stagename="{{ $StageName->stage_name }}" data-target-stage_note="{{ $StageName->stage_notes}}"
                            data-target="#edit_sampleModal">
                            <span class="fa fa-edit"></span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @include('samples::SamplesCreation.edit_sample_modal',['users'=>$Sample_bank->Sample_info])      

    </div> {{--end class card-body --}}
 </div> {{--end class card--}}

</div>
</div>
                <div class="text-center mt-5">
                    <a href="{{route('SampleBank.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            {{-- </form> --}}

            <div class="col"></div>
        </div> <!--close portlet_body-->
       
    </div>  <!--close portlet-->

        @endsection

{{-- =============================================================================================================== --}}
        @push('js')
       <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/select2.js')}}"></script>
        
        <script>
            $(document).ready(function () {

                $('#samplecode').prop('readonly', true); //  
                $("#customer_code ").prop('readonly', true);
                $("#fabrics_code").prop('readonly', true);
                $("#nopieces").prop('readonly', true);
                $("#op_type").prop('readonly', true);
                $('#classification').prop('readonly', true); // 
                $("#technical_description").prop('readonly', true);
                // =========================================================================================================
   $("#edit_sampleModal").on("show.bs.modal", function (e) {
    $('#edit_sampleHeading').html(" {{__('Edit Phase')}}");

                    var id = $(e.relatedTarget).data('target-id');
                    var stagename = $(e.relatedTarget).data('target-stagename');
                    var stage_note = $(e.relatedTarget).data('target-stage_note');
                    
                    $("#order_id").val(id);
                    $("#phase_name").val(stagename);
                   $("#phase_name").select2().trigger('change');
                    $('#stage_notes').val(stage_note); 

                    $('#phase_name').select2({
                dir: "{{LanguageAttributes::lang_code()=='ar'? 'rtl':'ltr'}}",
                dropdownAutoWidth: true,

      });
      $('#phase_name').validate().settings.ignore=[];

      // Find all existing Select2 instances
      $('.select2-hidden-accessible')
    // Attach event handler with some delay, waiting for the search field to be set up
    .on('select2:open', event => setTimeout(
        // Trigger focus using DOM API
        () => $(event.target).data('select2').dropdown.$search.get(0).focus(),
        10));


                });
              //  =======================================
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


    </script>
@endpush