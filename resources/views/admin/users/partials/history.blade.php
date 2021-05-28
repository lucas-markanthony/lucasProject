@isset($auditTrails)
    @if (count($auditTrails) >= 1)
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>#id</th>
                    <th>Timestamp</th>
                    <th>Action</th>
                    <th>External Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auditTrails as $auditTrail)
                <tr>
                    <td>{{ $auditTrail->id }}</td>
                    <td>{{ $auditTrail->created_at }}</td>
                    <td>{{ $auditTrail->action }}</td>
                    <td>{{ $auditTrail->externaldata }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3>No Records Found...</h3>
    @endif
@endisset