@if (count($transactionHistory) >= 1)
<table class="table table-responsive-sm table-bordered table-striped table-sm" name="txnHistory" id="txnHistory">
    <thead>
        <tr>
            <th>#Id</th>
            <th>Timestamp</th>
            <th>lrn</th>
            <th>Amount</th>
            <th>Remaining Balance</th>
            <th>External Data</th>
            <th>Receipt Number</th>
            <th>Cashier</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($transactionHistory as $item)
        <tr>
            <td scope="row">{{ $item->id }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->lrn }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->remaining_balance }}</td>
            <td>{{ $item->scheme_name }}</td>
            <td>{{ $item->receipt_number }}</td>
            <td>{{ $item->cashier }}</td>
            <td>
                <div>
                    @switch($item->status)
                        @case('SUCCESS')
                            <h5><span class="badge badge-success">{{ $item->status }}</span></h5>
                        @break
                        @case('FAILED')
                            <h5><span class="badge badge-info">{{ $item->status }}</span></h5>
                        @break
                        @default
                            <h5><span class="badge badge-dark">{{ $item->status }}</span></h5>
                    @endswitch
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <h3>No Records Found...</h3>
@endif