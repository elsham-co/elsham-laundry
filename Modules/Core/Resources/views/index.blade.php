@extends('core::layouts.app')
@section('title')
    {{__('Home')}}
@endsection
@section('content')
    @can('dashboard-content')
    <div class="row">
        <div class="col-12">
            Dashboard widgets goes here
        </div>
    </div>
@endcan
@endsection
