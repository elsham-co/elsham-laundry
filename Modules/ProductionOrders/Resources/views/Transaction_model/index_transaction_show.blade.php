
@extends('core::layouts.app')
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/thread-index.css')}}">
@endpush
@section('title')
    {{__('Follow-up stages')}}
@endsection
@section('content')

            <!-- BEGIN Portlet -->

            <div class="portlet-header">
                <h3 class="fa fa-balance-scale-right"> {{__('Follow-up stages')}}</h3>
            
            </div>

        
            <br>

            <div class="portlet">
                <div class="portlet-body table-responsive mt-4 data">
                    @include('productionorders::Transaction_model/transaction_table_show',['transaction'=>$transaction])
            
                </div>
{{-- -------------------------------------------------------------------------------------------- --}}
<div class="custom-cm" id="custom-cm">
    <div class="custom-cm__item" id="custom-cm__item1">
        <i class="fa fa-archive">  {{__('View canceled Sample Orders')}}</i>
    </div>

</div>
{{-- ---------------------------------------------------------------------------------------------- --}}
            </div>

            <!-- END Portlet -->
    


@endsection
@push('js')

@endpush
