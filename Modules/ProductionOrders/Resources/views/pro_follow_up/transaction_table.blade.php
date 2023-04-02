<div id="refresh">
    <table id="example" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th>#</th>
            <th style="text-align:center">{{__('Production Order')}}</th>
            <th style="text-align:center">{{__('Hall Name')}}</th>
            <th style="text-align:center">{{__('Stage Type')}}</th>
            <th style="text-align:center"> {{__('Created_at')}}</th>
            <th style="text-align:center">{{__('Follow Up Notes')}}</th>
        </tr>
        </thead>
        <tbody>
          
        @foreach($transaction['transaction'] as $key=> $Singale_transaction)
        
            <tr style="text-align:center">
                
                <th scope="row">{{$key+1}}</th>
                
                <td>{{$Singale_transaction->production_order}}</td>
                <td>{{$Singale_transaction->user}}</td>
                <td>{{$Singale_transaction->stage1}}</td>       
                <td>{{$Singale_transaction->created_at}}</td>
                <td>{{$Singale_transaction->transaction_note}}</td>
                 
            </tr>
          
        @endforeach
      
        </tbody>
    </table>
    
    {!! $transaction['transaction']->links('core::vendor.pagination.bootstrap-4') !!}   <p>
    </p>
    {{-- @include('samples::SamplesCreation.confirm_testsamplemodal') --}}
    </div>
