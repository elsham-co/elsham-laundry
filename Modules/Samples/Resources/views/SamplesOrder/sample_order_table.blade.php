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
            @can('receive_from_lab')
            <th>{{__('Lab Receipt Date')}}
                {{__('And')}}
                <br>
            {{__('From Lab Date')}}</th>
            @endcan
            @can('delivery-to-customer')
            <th>{{__('Delivery Date')}}
                {{__('And')}}
                <br>
                {{__('Delivered To')}}</th>
                @endcan
                @can('view-userCreater')
                  <th>{{__('Created_by')}}
                    {{__('And')}}
                   {{__('Created_at')}}</th>
                  @endcan
            @canany(['update-sampleorder','delete-sampleorder'])
                <th>{{__('Actions')}}</th>
            @endcan
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
     @can('receive_from_lab')
                <td>
                    @if(!empty($Sampleorder->Sample_creation['lab_receiptdate']))
                    <span class="badge badge-danger"> {{$Sampleorder->Sample_creation['lab_receiptdate']??''}}</span>
                    <br>
                    @if(empty($Sampleorder->fromlab_date))
                          @if(!empty($Sampleorder->Sample_creation['sample_date']))
                            <button  class="btn btn-outline-success btn-lg" 
                            id="confirmBtn"
                            onclick="change_fromlab_date([{{$Sampleorder->samplecode}}])">{{__('Confirmation')}}</button>
                          @endif
                     @else
                         <span class="badge badge-success"> {{$Sampleorder->fromlab_date}}</span>
                        @endif
                        @endif
                </td>
                @endcan
   @can('delivery-to-customer')
                <td>
                    @if(!empty($Sampleorder->fromlab_date) && empty($Sampleorder->DeliveryDate))
                    <button type="button" class="btn btn-success" value="{{ $Sampleorder->id }}" data-toggle="modal" data-target-id="{{ $Sampleorder->id }}" data-target-code="{{ $Sampleorder->samplecode }}" 
                        data-target-name="{{ $Sampleorder->customer_info }}" 
                        data-target="#deliversampleModal">{{__('Confirm')}}</button>
                        @else
                        {{$Sampleorder->DeliveryDate ??''}}
                        <br>
                        {{$Sampleorder->Deliveredto ??''}}
                        @endif
                </td>
        @endcan
  @can('view-userCreater')
                  @if(!empty($Sampleorder->user))
                            <td>{{$Sampleorder->user}}
                           <br>
                           {{$Sampleorder->created_at}}</td>
                           @else
                           <td>{{__('Not Available')}}
                            <br>
                            {{$Sampleorder->created_at}}</td>
                           @endif
                        @endcan
                        @canany(['update-sampleorder','delete-sampleorder'])
                        <td>
                              @can('update-sampleorder')
                            <a href="{{route('SamplesOrder.edit',$Sampleorder->samplecode)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete-sampleorder') 
                        @if(empty($Sampleorder->Sample_creation->lab_receiptdate))
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                        id="delete_permission-{{$Sampleorder->samplecode}}"
                        onclick="delete_sampleorder([{{$Sampleorder->samplecode}}])" title={{__('Delete')}}>
                    <i class="fa fa-trash"></i>
                </button>
                @endif
                        @endcan
                    </td>
                @endcan
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $sample_orders['samples_order']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
   @include('samples::SamplesOrder.deliveredtocustomers')
    </div>