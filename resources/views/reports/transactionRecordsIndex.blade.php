@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Transaction Report</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('report.enrollment.showSearchTransactions') }}">
                @csrf

                <div class="mt-1 mb-3 bottom">
                    <strong>Filter by</strong>
                </div>

                <div class="input-group"><span class="input-group-prepend">
                    <button class="btn btn-primary" type="button" disabled>
                        <i class="cil-magnifying-glass"></i>
                    </button></span>
                    <input class="form-control" id="text_input" type="text" name="text_input" placeholder="" autocomplete="">
                    <span class="input-group-append">
                        <div class="col-md-9 col-form-label">
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" id="input_type1" type="radio" checked="checked" value="lrn" name="input_type">
                                <label class="form-check-label" for="input_type1">LRN</label>
                            </div>
                            <div class="form-check form-check-inline mr-1">
                                <input class="form-check-input" id="input_type2" type="radio" value="receipt" name="input_type">
                                <label class="form-check-label" for="input_type2">Receipt No.</label>
                            </div>
                        </div>
                    </span>
                </div>
                    
                    <button class="btn-sm btn-primary mt-3 float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
                </form>
            </div> 
        </div>
    </div>
</div>

@isset($searchdata)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Search Result</h5></div>
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Search Input</span></div>
                            <input class="form-control" id="school_year_data" type="text" name="school_year_data" value="{{ $requestdata }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="mx-2">
                    @if (count($searchdata) >= 1)

                    <font size="1">
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">

                            <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>timestamp</th>
                                    <th>Receipt No.</th>
                                    <th>Full Amount</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>External Data</th>
                                    <th>Cashier</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($searchdata as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->updated_at }}</td>
                                    <td>{{ $data->receipt_number }}</td>
                                    <td>{{ $data->full_amount }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->payment }}</td>
                                    <td>{{ $data->scheme_name }}</td>
                                    <td>{{ $data->cashier }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </font>
                    @else
                        <h4>No Records Found...</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endisset


@endsection

@section('third_party_scripts')
<script type="text/javascript">
    
</script>
@endsection