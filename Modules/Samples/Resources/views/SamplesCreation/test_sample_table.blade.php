<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('SamplesOrder ID')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th > {{__('Fabrics Name')}}</th>
            <th style="display:none;">{{__('Colors Name')}}</th>
            <th style="display:none;">{{__('Fashion Name')}}</th>
                  @can('create-sample')   
                  <th>{{__('Sample Confirmation')}}</th>
                  @endcan
            {{-- @canany(['update-customer','delete-customer']) --}}
                {{-- <th>{{__('Actions')}}</th> --}}
            {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
        @foreach($TestSample['samples_order'] as $key=> $Singale_Sample)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Singale_Sample->samplecode}}</td>
           
                <td>{{$Singale_Sample->customer_info['customers_name']}}</td>
                <td >{{$Singale_Sample->Fabric_info['fabricName']}}</td>

                <td style="display:none;">{{$Singale_Sample->colors_code}} </td> 
                <td style="display:none;">{{$Singale_Sample->fashion_code}}</td>
                  {{-- @can('view-userCreater') --}}
                  @can('create-sample')  
                  @if(empty($Singale_Sample->Sample_creation['lab_receiptdate']))
                          <td>
                            {{-- <button id="preperation-confirm" class="btn btn-success">{{__('Confirm')}}</button> --}}
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target-id="{{ $Singale_Sample->id }}" data-target-code="{{ $Singale_Sample->samplecode }}" 
                                data-target-name="{{ $Singale_Sample->customer_info['customers_name'] }}" data-target-fabric="{{ $Singale_Sample->Fabric_info['fabricName'] }}"
                                data-target-colors="{{ $Singale_Sample->colors_code }}" data-target-fashion="{{ $Singale_Sample->fashion_code }}"  data-target-samplenote="{{$Singale_Sample->samplesnotes}}"
                                data-target="#testsampleModal">{{__('Confirm')}}</button>
                          </td>
                          @else
                          <td>{{$Singale_Sample->Sample_creation['lab_receiptdate']}}</td>
                          @endif
                        @endcan
                      
                        
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $TestSample['samples_order']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    @include('samples::SamplesCreation.confirm_testsamplemodal')
    </div>
