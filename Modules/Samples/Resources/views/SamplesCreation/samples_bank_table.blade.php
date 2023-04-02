<div id="refresh">
    <table id="datatable-4" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('SamplesOrder ID')}}</th>
            <th>{{__('Technical Description')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th> {{__('Fabrics Name')}}</th>
            <th> {{__('Sample Date')}}</th>
            <th>{{__('To C.S. Date')}}</th>
            <th>{{__('Phases')}}</th>
                  {{-- @canany(['update-customer','delete-customer'])  --}}  
                  
                  {{-- @endcan --}}
            @canany(['update-sample','samples'])
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
          
        @foreach($banksamples['sample_creation'] as $key=> $Singale_Sample)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Singale_Sample->samplecode}}</td>
                <td>{{$Singale_Sample->technical_description}}</td>
                <td>{{$Singale_Sample->customer_info}}</td>
                <td >{{$Singale_Sample->Fabric_info}}</td>
                <td>{{$Singale_Sample->sample_date}}</td>
                <td>{{$Singale_Sample->Sample_order}}</td>
                <td>
                @foreach (json_decode($Singale_Sample->Sample_info) as $Singale_Stage)
                {{-- @foreach($Singale_Sample->Sample_info as $key=> $Singale_Stage) --}}
                {{-- <td>{{$Singale_Sample->Sample_info}}</td> --}}
                {{-- {{$Singale_Stage}} --}}
                <span class="badge badge-secondary">  {{$Singale_Stage}}</span>
                @endforeach
            </td>
                  {{-- @can('view-userCreater') --}}
                  {{-- @if(!empty($Singale_Sample->Sample_creation['lab_receiptdate']))
                          <td>
                                {{$Singale_Sample->Sample_creation['lab_receiptdate']}}
                          </td>
                          @endif --}}
                        {{-- @endcan --}}
                        @canany(['update-sample','samples'])
                       
                        <td> 
                        @can('samples')
                            <a href="{{route('SampleBank.view',$Singale_Sample->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Update')}}>
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan
                            @can('update-sample')
                            <a href="{{route('SampleBank.edit',$Singale_Sample->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Update')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{route('SampleReCreate.edit',$Singale_Sample->id)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Create')}}>
                                <i class="fa fa-retweet" aria-hidden="true"></i>


                            </a>
                            @endcan
                    </td>
                @endcan
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $banksamples['sample_creation']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    {{-- @include('samples::SamplesCreation.confirm_testsamplemodal') --}}
    </div>
