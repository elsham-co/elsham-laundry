@extends('core::layouts.app')

@section('title')
    {{__('Edit Fabrics')}}
@endsection
@push('css')
<link href="{{asset('css/google-fonts.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/fabrics_create.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> --}}
@endpush
@section('content')
    <header class="head_name" >
        <h3 class="fa fa-feather" >
            {{__('Edit Fabrics')}}
       </h3>
    </header>
    <br>
    <div class="portlet">
      
        <div class="portlet-body d-flex align-items-center justify-content-center">
            <form action="{{route('Fabrics.update',$Fabric->id)}}" method="POST" id="Update_Fabrics" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
        
            <!-- BEGIN Form Group -->
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                             <div class="form-group"  >
                                    <label for="fabric_code">{{__('Fabrics ID')}} :</label>
                                    
                                    <input type="text" class="form-control" value="{{$Fabric->fabric_code}}" id="fabric_code" name="fabric_code">
                                </div>
                                <div class="form-group">
                                    <label for="fabricName">{{__('Fabrics Name')}} :</label>
                                    <input type="text" class="form-control" value="{{$Fabric->fabricName}}" placeholder="{{__('Please... Enter the Fabric Name')}}" id="fabricName" name="fabricName">
                                </div>
                   
                            <div class="form-group">

                                 <label for="Categoryfab_name">{{__('Fabrics Category')}} :</label>
                                 <input type="text" class="form-control" value="{{$Fabric->info}}" placeholder="{{__('Please... Enter the Fabric Name')}}" id="Categoryfab_name" name="Categoryfab_name">
                            </div>
                            <div class="form-group" >
                                <label for="fabricnotes">{{__('Fabrics Notes')}} :</label>
                               
                                <textarea rows="3" cols="30" id="fabricnotes" class="form-control" name="fabricnotes" placeholder="{{__('Please... Enter the Fabric Notes')}}">{{$Fabric->fabricnotes}}</textarea>
                            </div>
                        </div>
                    </div>
    
                <div class="text-center mt-5">
                    <a href="{{route('Fabrics.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
                </div>
                
            </form>
        </div> <!--close portlet_body-->
    </div>  <!--close portlet-->

        @endsection
        @push('js')
        <script>
            $(document).ready(function () {
                $('#fabric_code').prop('readonly', true); //  
                $('#fabricName').prop('readonly', true); //  
                $('#Categoryfab_name').prop('readonly', true); //  
                $('#fabricnotes').prop('readonly', true); //  
            });
            </script>
@endpush