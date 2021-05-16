@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h3>Enrollment Report</h3></div>
            <div class="card-body">
                <form method="POST" action="{{ route('report.enrollment.showSearchEnrollment') }}">
                @csrf

                <div class="mt-3 mb-3 bottom">
                    <strong>Filter by</strong>
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
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="section">Section</label><span class="text-danger"> *</span>
                            <select class="form-control" id="section" name="section">
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 mb-3 bottom">
                        <strong>Sort by</strong>
                    </div>

                    <div class="row mt-2">
                        <div class="form-group col-sm-6">
                            <label for="sort_gender">Gender</label><span class="text-danger"> *</span>
                            <select class="form-control" id="sort_gender" name="sort_gender">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="sort_lname">Last Name</label><span class="text-danger"> *</span>
                            <select class="form-control" id="sort_lname" name="sort_lname">
                                <option value="asc">Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                    
                    <button class="btn-lg btn-primary float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
                </form>
            </div> 
        </div>
    </div>
</div>

@isset($searchResultData)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4>Search Result</h4></div>
            <div class="card-body">
                <div class="mx-2">
                    @if (count($searchResultData) >= 1)
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>School Year</th>
                                    <th>Grade</th>
                                    <th>Section</th>
                                    <th>Enrollment_Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($searchResultData as $student)
                                <tr>
                                    <td scope="row">{{ $student->lrn }}</td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->middle_name }}</td>
                                    <td>{{ $student->last_name }} {{ $student->ext_name }}</td>
                                    <td>{{ $student->gender }}</td>
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $searchResultData->links() }}
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
        getActiveSchYear();

        getGrade($('#school_year').val());
        getSection($('#school_year').val() + "|" + $('#grade').val());
        

        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($('#school_year').val() +"|"+ $('#grade').val());
        });

        jQuery('#school_year').change(function(e){
            e.preventDefault();
            getGrade($(this).val());
        });

    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function getSection($dataVal){
        var data = $dataVal;
                if(data) {
                    $.ajax({
                    url: '/ajax/section/'+data,
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

    function getGrade($dataVal){
        var data = $dataVal;
        var data1 = "";
                if(data) {
                    $.ajax({
                    url: '/ajax/grade/'+data,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="grade"]').empty();
                        $('select[name="grade"]').append('<option value="all">all</option>');
                        $.each(data, function(key, value) {
                        $('select[name="grade"]').append('<option value="'+ value['grade'] +'">'+ value['grade'] +'</option>');
                    });
                }
            });
            
            getSection($('#school_year').val() + "|" + $('#grade').val());
        }else{
            $('select[name="grade"]').empty();
        }
    }

    function getActiveSchYear(){
        var currentYear = '2022';
        var d = new Date();
        var currentYear = d.getFullYear();

        $("#school_year option").each(function()
        {
            // Add $(this).val() to your list
            $item = $(this).val().split("-");
            if($item[0] == currentYear){
                $('#school_year').val($(this).val()).change();
                //console.log('test');
            }
        });
    }
    
</script>
@endsection 