 
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('View canceled Sample Orders')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-vial">{{__('View canceled Sample Orders')}}</h3>
            </div>

           
                       
                <div class="col-12 mt-5 mb-3" id="searchbox">
                    @include('core::search',['route'=>'SamplesOrder.trashed'])
                    <span class="note">{{__('accepts arabic and english letters and numbers')}}</span>
                </div>
            <br>


            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('samples::SamplesOrder/deleted_sampleorder_table',['sample_orders'=>$sample_orders])
              
                </div>
 {{-- -------------------------------------------------------------------------------------------- --}}
 <div class="custom-cm" id="custom-cm">
 <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('Back to main content')}}</i>
    </div>
 </div>
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>

            <!-- END Portlet -->
    
@endsection
@push('js')
<script type="text/javascript" src="{{asset('js/context_menu.js')}}"></script>
<script>
// ===========================================================================
    $(document).ready(function () {
        // context menu Items
$("#custom-cm__item1").click(function() {
window.location.href = "{{route('SamplesOrder.index')}}";
});
// =========================================================================================================
// =========================================================================================================
        // accpet Arabic -English -numbres only in input text
        const $input= document.querySelector("#searchbox");
const Thread_Search_CHARS_REGEXP = /[0-9\/^A-Za-z\u0600-\u06FF/ ]+/;

$input.addEventListener("beforeinput", e => {
    if
    (!Thread_Search_CHARS_REGEXP.test(e.data))
   
    {
        e.preventDefault();
    }
});
// ------------------------------------------------------------------------------
function validate(input){
  if(/^\s/.test(input.value))
    input.value = '';
}
 //  // ========================================================================================================= --}}
    });
    </script>
@endpush



        




        
