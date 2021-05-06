<table class="table table-responsive-sm table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>School Year</th>
            <th>Item</th>
            <th>Full amount</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @php
            $data = 0;
        @endphp
    @foreach($remainingBalance as $balitem)
        <tr>
            <td scope="row">{{ $balitem->school_year }}</td>
            <td>{{ $balitem->feeName }}</td>
            <td>{{ $balitem->fullAmout }}</td>
            <td>{{ $balitem->balance }}</td>
            @php
                $data += $balitem->balance;
            @endphp
        </tr>
    @endforeach
    </tbody>
    <tr>
        <td></td>
        <td></td>
        <td>Total:</td>
        <td><strong>{{ $data }}</strong></td>
    </tr>
</table>