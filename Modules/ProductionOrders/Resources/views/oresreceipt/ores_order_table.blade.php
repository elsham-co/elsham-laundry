<div id="refresh">
    <table id="datatable-3" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th>{{__('Receipt Code')}}</th>
            <th>{{__('Customer Name')}}</th>
            <th>{{__('Receipt Date')}}</th>
            <th>{{__('Model No')}}</th>
            <th>
                {{__('Fabrics Name')}}
            </th>
            <th>{{__('Materials Receiver')}}</th>
    
                @can('view-userCreater')
                  <th>{{__('Created_by')}}
                    {{__('And')}}
                   {{__('Created_at')}}</th>
                  @endcan
            @canany(['update-oresorder','delete-oresorder'])
                <th>{{__('Actions')}}</th>
            @endcan
        </tr>
        </thead>
        <tbody>
          
        @foreach($Oresorders['ores_recipt'] as $key=> $Oresorder)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Oresorder->orescode}}</td>
           
                <td >{{$Oresorder->customer_info}}</td>
                <td>{{$Oresorder->ores_recipt_date}}</td>
                <td>{{$Oresorder->model_no}}</td>
                
                <td>{{$Oresorder->Fabric_info}}</td>
        
                <td>{{$Oresorder->materials_receiver}} </td> 
  
   
  @can('view-userCreater')
                  @if(!empty($Oresorder->user))
                            <td>{{$Oresorder->user}}
                           <br>
                           {{$Oresorder->created_at}}</td>
                           @else
                           <td>{{__('Not Available')}}
                            <br>
                            {{$Oresorder->created_at}}</td>
                           @endif
                        @endcan
                        @canany(['update-oresorder','delete-oresorder'])
                        <td>
                              @can('update-oresorder')
                            <a href="{{route('SamplesOrder.edit',$Oresorder->orescode)}}"  class="btn btn-label-primary btn-icon mr-1 ml-1" title={{__('Modify')}}>
                                <i class="fa fa-edit"></i>
                            </a>
                        @endcan
                        @can('delete-oresorder') 
                        {{-- @if(empty($Sampleorder->Sample_creation->lab_receiptdate))
                        <button class="btn btn-label-danger btn-icon mr-1 ml-1"
                        id="delete_permission-{{$orescode->orescode}}"
                        onclick="delete_sampleorder([{{$orescode->orescode}}])" title={{__('Delete')}}>
                    <i class="fa fa-trash"></i>
                </button>
                @endif --}}
                        @endcan
                    </td>
                @endcan
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $Oresorders['ores_recipt']->withQueryString()->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    </div>