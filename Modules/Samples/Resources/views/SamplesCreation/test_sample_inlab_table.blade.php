<div id="refresh">
    <table id="datatable-4" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('SamplesOrder ID')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th> {{__('Fabrics Name')}}</th>
            <th>{{__('Colors Name')}}</th>
            <th>{{__('Fashion Name')}}</th>
                  {{-- @canany(['update-customer','delete-customer'])  --}}  
                  <th>{{__('Lab Receipt Date')}}</th>
                  {{-- @endcan --}}
                  <th>{{__('days difference')}}</th>
                  @canany(['create-sample','delete-sampleorder'])
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
          
        @foreach($TestSampleInLab['samples_order'] as $key=> $Singale_Sample)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Singale_Sample->samplecode}}</td>
           
                <td>{{$Singale_Sample->customer_info['customers_name']}}</td>
                <td >{{$Singale_Sample->Fabric_info['fabricName']}}</td>

                <td >
                    @if(!empty($Singale_Sample->colors_code)) 
                    @foreach (json_decode($Singale_Sample->colors_code) as $singleColor)
                    <span class="badge badge-secondary"> {{ $singleColor }}</span>
                @endforeach
                @else
                <span class="badge badge-warning"> {{ $Singale_Sample->samplesnotes }}</span>
                    @endif
                </td> 
                <td >
                    @if(!empty($Singale_Sample->fashion_code)) 
                    @foreach (json_decode($Singale_Sample->fashion_code) as $singleTag)
                          <span class="badge badge-secondary"> {{ $singleTag }}</span>
                           @endforeach
                           @else
                           @if(!empty($Singale_Sample->samplesnotes)) 
                           <span class="badge badge-warning"> {{ $Singale_Sample->samplesnotes }}</span>
                           @endif
                    @endif
                </td>
                  {{-- @can('view-userCreater') --}}
                  @if(!empty($Singale_Sample->Sample_creation['lab_receiptdate']))
                          <td>
                                {{$Singale_Sample->Sample_creation['lab_receiptdate']}}
                          </td>
                          @endif
                        {{-- @endcan --}}
                        <td>{{ now()->diffInDays($Singale_Sample->Sample_creation['lab_receiptdate'])+1 }}</td>
                        @canany(['create-sample','delete-sampleorder'])
                        <td>
                            {{-- @can('view-Fabric') --}}

                            {{-- <a href="{{route('Fabrics.show',$Color->id)}}"
                               class="btn btn-label-secondary btn-icon mr-1 ml-1 mt-1" title={{__('Details')}}>
                                <i class="fa fa-eye"></i>
                            </a> --}}
                        {{-- @endcan --}}   
                        @can('create-sample')
                            <a href="{{route('SamplesCreation.edit',$Singale_Sample->id)}}"  class="btn btn-label-success btn-icon mr-1 ml-1" title={{__('Create')}}>
                                <i class="fa fa-plus"></i>
                            </a>
                        @endcan 
                        @can('delete-sampleorder') 
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                        id="delete_permission-{{$Singale_Sample->samplecode}}"
                        onclick="delete_sampleorder([{{$Singale_Sample->samplecode}}])" title={{__('Delete')}}>
                    <i class="fa fa-trash"></i>
                </button>
                        @endcan
                    </td>
                @endcan
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $TestSampleInLab['samples_order']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    {{-- @include('samples::SamplesCreation.confirm_testsamplemodal') --}}
    </div>
