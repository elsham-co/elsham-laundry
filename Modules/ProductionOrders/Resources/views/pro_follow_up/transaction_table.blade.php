
<div id="refresh">
    <div class="portlet-header" style="text-align: center">
        <h3 class="fa" style="text-align: center">{{__('Customer Name')}} - {{$transaction->Customer->customers_name}}</h3>
    </div>
{{--  --}}
    <table id="example" class="table table-bordered table-striped table-hover">
        <thead>
        <tr style="text-align:center">
            <th style="text-align:center">{{__('Production Order')}}</th>
            <th style="text-align:center">{{__('Stage Type')}}</th>
            <th style="text-align:center"> {{__('Created_at')}}</th>
            <th style="text-align:center">{{__('Follow Up Notes')}}</th>
        </tr>
        </thead>
        <tbody>
        
        @foreach($transaction->order as $Singale_transaction)
            <tr style="text-align:center">
                <td>{{$Singale_transaction->production_order}}</td>
                <td>{{$Singale_transaction->stage1}}</td>
                <td>{{$Singale_transaction->created_at}}</td>
                <td>{{$Singale_transaction->transaction_note}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center mt-5">
        <a href="{{route('movements.index')}}" class="btn btn-danger btn-lg">{{__('Cancel')}}</a>
    </div>
    </p>
    </div>
