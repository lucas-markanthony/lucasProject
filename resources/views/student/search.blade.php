@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h1>Search</h1></div>
            <div class="card-body">
                <form method="POST" action="{{ route('registrar.student.searchRecord') }}">
                @csrf
                    <div class="input-group"><span class="input-group-prepend">
                        <button class="btn btn-primary" type="button" disabled>
                            <i class="cil-magnifying-glass"></i>
                        </button></span>
                        <input class="form-control" id="text_input" type="text" maxlength="50" name="text_input" placeholder="" autocomplete="">
                        <span class="input-group-append">
                            <div class="col-md-9 col-form-label">
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input" id="input_type1" type="radio" checked="checked" value="lrn" name="input_type">
                                    <label class="form-check-label" for="input_type1">LRN</label>
                                </div>
                                <div class="form-check form-check-inline mr-1">
                                    <input class="form-check-input" id="input_type2" type="radio" value="lname" name="input_type">
                                    <label class="form-check-label" for="input_type2">LAST NAME</label>
                                </div>
                            </div>
                        </span>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-sm-4">
                            <label for="school-year">School Year</label><span class="text-danger"> *</span>
                            <select class="form-control" id="school_year" name="school_year">
                                @foreach ($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="grade">Grade</label><span class="text-danger"> *</span>
                            <select class="form-control" id="grade" name="grade">
                                <option value="all">all</option>
                                @foreach ($gradeList as $grade)
                                    <option value="{{ $grade->grade }}">{{ $grade->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="section">Section</label><span class="text-danger"> *</span>
                            <select class="form-control" id="section" name="section">
                            </select>
                        </div>
                    </div>
                    
                    <button class="btn-lg btn-primary float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
                </form>
            </div> 
        </div>
    </div>
</div>


@isset($searchResult)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h2>Search Result</h2></div>
            <div class="card-body">
                <div class="mx-2">
                    @if (count($searchResult) >= 1)
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th>Name</th>
                                    <th>School_YEAR</th>
                                    <th>Grade</th>
                                    <th>Section</th>
                                    <th>Enrollment_Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($searchResult as $student)
                                <tr>
                                    <td scope="row">{{ $student->lrn }}</td>
                                    <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->ext_name }}</td>
                                    <td>{{ $student->school_year }}</td>
                                    <td>{{ $student->grade }}</td>
                                    <td>{{ $student->section }}</td>
                                    <td>
                                        @switch($student->enrollment_status)
                                            @case('ENROLLED')
                                                <span class="badge badge-success">{{ $student->enrollment_status }}</span>
                                            @break
                                            @case('COMPLETED')
                                                <span class="badge badge-info">{{ $student->enrollment_status }}</span>
                                            @break
                                            @default
                                                <span class="badge badge-danger">{{ $student->enrollment_status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary align-middle" href="{{ route('registrar.student.show', $student->lrn) }}" role="button">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $searchResult->links() }}
                    @else
                        <h3>No Records Found...</h3>
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
    jQuery(document).ready(function(){
        getSection($('#grade').val());

        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($(this).val());
        });
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function getSection($gradeVal){
        var grade = $gradeVal;
                if(grade) {
                    $.ajax({
                    url: '/ajax/section/'+grade,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="section"]').empty();
                        $('select[name="section"]').append('<option value="all">all</option>');
                        $.each(data, function(key, value) {
                        $('select[name="section"]').append('<option value="'+ value['section'] +'">'+ value['section'] +'</option>');
                    });
                }
            });
        }else{
            $('select[name="section"]').empty();
        }
    }
</script>
@endsection