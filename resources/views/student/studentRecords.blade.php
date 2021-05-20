@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Search</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('registrar.student.searchStudentRecord') }}">
                @csrf
                    

                    <div class="row mt-2">
                        <div class="form-group col-sm-8">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn btn-primary" type="button" disabled>
                                    LRN
                                </button></span>
                                <input class="form-control" id="text_input" type="text" maxlength="50" name="text_input" placeholder="" autocomplete="">
                                <span class="input-group-append ml-3">
                                    <label>School Year</label><span class="text-danger"> *</span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <select class="form-control" id="school_year" name="school_year">
                                @foreach ($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    
                    <button class="btn-sm btn-primary mt-3 float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
                </form>
            </div> 
        </div>
    </div>
</div>

@isset($studentdetails)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Search Result</h5></div>
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">LRN</span></div>
                            <input class="form-control" id="school_year_data" type="text" name="school_year_data" value="{{ $studentdetails->lrn }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Name</span></div>
                            <input class="form-control" id="grade_data" type="text" name="grade_data" value="{{ $studentdetails->last_name }}, {{ $studentdetails->first_name }} {{ $studentdetails->middle_name }} {{ $studentdetails->ext_name }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">School Year</span></div>
                            <input class="form-control" id="section_data" type="text" name="section_data" value="{{ $studentdetails->school_year }}" readonly>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Grade</span></div>
                            <input class="form-control" id="section_data" type="text" name="section_data" value="{{ $studentdetails->grade }}" readonly>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Section</span></div>
                            <input class="form-control" id="subject_data" type="text" name="subject_data" value="{{ $studentdetails->section }}" readonly>
                        </div>
                    </div>
                </div>

            <!--div>
                <button class="btn-sm btn-primary mb-2 ml-2 float-right" type="button" id="btn-update" name="btn-update">Update</button>
                <button class="btn-sm btn-primary mb-2 ml-2 float-right" type="button" id="btn-done" name="btn-done">Done</button>
            </div-->


                <div class="mx-2">
                    @if (count($studentrecords) >= 1)

                    <font size="2">
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <colgroup>
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 60%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 5%;">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th>Subject</th>
                                    <th>1st Grading</th>
                                    <th>2nd Grading</th>
                                    <th>3rd Grading</th>
                                    <th>4th Grading</th>
                                    <th>Final</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($studentrecords as $studentrecord)
                                <tr>
                                    <td></td>
                                    <td>{{ $studentrecord->subject }}</td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1" name="grade1" onkeypress="return isNumberKey(event)" value="{{ $studentrecord->first_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1" name="grade1" onkeypress="return isNumberKey(event)" value="{{ $studentrecord->second_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1" name="grade1" onkeypress="return isNumberKey(event)" value="{{ $studentrecord->third_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1" name="grade1" onkeypress="return isNumberKey(event)" value="{{ $studentrecord->fourth_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1" name="grade1" onkeypress="return isNumberKey(event)" value="{{ $studentrecord->final_grading }}" readonly></td>
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
