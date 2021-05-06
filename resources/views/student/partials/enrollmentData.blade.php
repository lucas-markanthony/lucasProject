<table class="table table-responsive-sm table-bordered table-striped table-sm" name="enrollmentData" id="enrollmentData">
    <thead>
        <tr>
            <th>#lrn</th>
            <th>school_year</th>
            <th>grade</th>
            <th>section</th>
            <th>enrollment_status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($enrollmentHistory as $item)
        <tr>
            <td scope="row">{{ $item->lrn }}</td>
            <td>{{ $item->school_year }}</td>
            <td>{{ $item->grade }}</td>
            <td>{{ $item->section }}</td>
            <td>
                @switch($item->enrollment_status)
                    @case('ENROLLED')
                        <span class="badge badge-success">{{ $item->enrollment_status }}</span>
                    @break
                    @case('COMPLETED')
                        <span class="badge badge-info">{{ $item->enrollment_status }}</span>
                    @break
                    @case('FAILED')
                        <span class="badge badge-dark">{{ $item->enrollment_status }}</span>
                    @break
                    @case('DROPPED')
                        <span class="badge badge-danger">{{ $item->enrollment_status }}</span>
                    @break
                    @default
                        <span class="badge badge-danger">{{ $item->enrollment_status }}</span>
                @endswitch
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $enrollmentHistory->links() }}