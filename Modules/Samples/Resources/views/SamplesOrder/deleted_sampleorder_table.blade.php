<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('SamplesOrder ID')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th>{{__('Receipt Date')}}</th>
 
            <th>
                {{__('Fabrics Name')}}
            </th>
            <th>{{__('Colors Name')}}</th>
            <th>{{__('Fashion Name')}}</th>
            <th>{{__('Lab Receipt Date')}}
                  @can('view-userCreater')
                  <th>{{__('Deleted_by')}}
                    {{__('And')}}
                   {{__('Deleted_at')}}</th>
                  @endcan
            {{-- @canany(['update-customer','delete-customer']) --}}
                {{-- <th>{{__('Actions')}}</th> --}}
            {{-- @endcan --}}
        </tr>
        </thead>
        <tbody>
          
        @foreach($sample_orders['samples_order'] as $key=> $Sampleorder)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Sampleorder->samplecode}}</td>
           
                <td dir="ltr">{{$Sampleorder->customer_info}}</td>
                <td>{{$Sampleorder->ReceiptDate}}</td>
          
                <td dir="ltr">{{$Sampleorder->Fabric_info}}</td>
        
                <td>
                    @if(!empty($Sampleorder->colors_code)) 
                    @foreach (json_decode($Sampleorder->colors_code) as $singleColor)
                    <span class="badge badge-secondary"> {{ $singleColor }}</span>
                @endforeach
                @else
                <span class="badge badge-warning"> {{ $Sampleorder->samplesnotes }}</span>
                    @endif
                </td> 
                <td>
                    @if(!empty($Sampleorder->fashion_code)) 
                     @foreach (json_decode($Sampleorder->fashion_code) as $singleTag)
                                <span class="badge badge-secondary"> {{ $singleTag }}</span>
                            @endforeach
                            @else
                            @if(!empty($Sampleorder->samplesnotes)) 
                            <span class="badge badge-warning"> {{ $Sampleorder->samplesnotes }}</span>
                            @endif
                     @endif
                </td>
                <td>
                    @if(!empty($Sampleorder->Sample_creation['lab_receiptdate']))
                    <span class="badge badge-danger"> {{$Sampleorder->Sample_creation['lab_receiptdate']??''}}</span>
                        @endif              
                </td>
                  @can('view-userCreater')
                  @if(!empty($Sampleorder->user))
                            <td>{{$Sampleorder->user}}
                           <br>
                           {{$Sampleorder->deleted_at}}</td>
                           @else
                           <td>{{__('Not Available')}}
                            <br>
                            {{$Sampleorder->deleted_at}}</td>
                           @endif
                        @endcan
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $sample_orders['samples_order']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
   @include('samples::SamplesOrder.deliveredtocustomers')
    </div>