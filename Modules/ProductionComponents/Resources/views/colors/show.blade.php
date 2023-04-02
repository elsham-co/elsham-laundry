
@extends('core::layouts.app')
@section('title')
    {{__('select colors')}}
@endsection
@section('content')


          
            <!-- BEGIN Portlet -->
            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h3 class="portlet-title">{{__('select colors')}}</h3>
                </div>
             
             
                       
                <div class="col-12 mt-5 mb-3">

                    @include('core::search',['route'=>'admins'])
                </div>
            <br>
           <div>
            <table id="datatable-3" class="table table-bordered table-striped table-hover">
                <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th>{{__('ChemicalName')}}</th>
                    <th>{{__('Category_ChemicalName')}}</th>
{{--}}
                    <th>{{__('Phone Number')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Roles')}}</th>
                --}}
                    @canany(['update-admin','delete-admin'])
                        <th>{{__('Actions')}}</th>
                    @endcan
                </tr>
                </thead>
                <tbody >
</tbody>
</table>
        </div>
                {{--}}

                <div class="portlet-body table-responsive mt-4 data">
                    @include('admins::table',['admins',$admins])
              
                </div>

            </div>
 --}}
            <!-- END Portlet -->
    


@endsection




        