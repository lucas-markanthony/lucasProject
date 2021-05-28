@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h4>Cashier Menu</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('cashier.student.searchRecord') }}">
                @csrf
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
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="section">Section</label><span class="text-danger"> *</span>
                            <select class="form-control" id="section" name="section">
                            </select>
                        </div>
                    </div>
                    
                    <button class="btn-sm btn-primary float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
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
                                        <a class="btn btn-sm btn-primary align-middle" href="{{ route('cashier.student.show', $student->lrn) }}" role="button">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
        getActiveSchYear()

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

    function getSection($dataVal){
        var data = $dataVal;
                if(data) {
                    $.ajax({
                    url: '/ajax/section/'+data,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="section"]').empty();
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
                        $.each(data, function(key, value) {
                            if(key == 0){
                                getSection($('#school_year').val() + "|" + value['grade']);
                            }
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