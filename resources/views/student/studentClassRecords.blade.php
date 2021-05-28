@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Search</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('registrar.student.searchClass') }}">
                @csrf
                    <div class="row mt-2">
                        <div class="form-group col-sm-3">
                            <label for="school-year">School Year</label><span class="text-danger"> *</span>
                            <select class="form-control" id="school_year" name="school_year">
                                @foreach ($schoolyears as $schoolyear)
                                    <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="grade">Grade</label><span class="text-danger"> *</span>
                            <select class="form-control" id="grade" name="grade">
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="section">Section</label><span class="text-danger"> *</span>
                            <select class="form-control" id="section" name="section">
                            </select>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="section">Subject</label><span class="text-danger"> *</span>
                            <select class="form-control" id="subject" name="subject">
                            </select>
                        </div>

                    </div>
                    
                    <button class="btn-sm btn-primary float-right" type="submit"><i class="cil-magnifying-glass"></i>  Search</button>
                </form>
            </div> 
        </div>
    </div>
</div>

@isset($classrecords)
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h5>Search Result</h5></div>
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">School Year</span></div>
                            <input class="form-control" id="school_year_data" type="text" name="school_year_data" value="{{ $school_year }}" readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Grade</span></div>
                            <input class="form-control" id="grade_data" type="text" name="grade_data" value="{{ $grade }}" readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Section</span></div>
                            <input class="form-control" id="section_data" type="text" name="section_data" value="{{ $section }}" readonly>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Subject</span></div>
                            <input class="form-control" id="subject_data" type="text" name="subject_data" value="{{ $subject }}" readonly>
                        </div>
                    </div>
                </div>

            


               
                @if (count($classrecords) >= 1)
                    <div>
                        <button class="btn-sm btn-primary mb-2 ml-2 float-right" type="button" id="btn-update" name="btn-update">Update</button>
                        <button class="btn-sm btn-primary mb-2 ml-2 float-right" type="button" id="btn-done" name="btn-done">Done</button>
                    </div>

                <div class="mx-2">
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
                                    <th>Name</th>
                                    <th>1st Grading</th>
                                    <th>2nd Grading</th>
                                    <th>3rd Grading</th>
                                    <th>4th Grading</th>
                                    <th>Final</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($classrecords as $student)
                                <tr>
                                    <td scope="row">{{ $student->lrn }}</td>
                                    <td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }} {{ $student->ext_name }}</td>
                                    <td><input type="text" size="5" class="inputGrid1 gradeInput" id="grade1-{{ $student->subject }}-{{ $student->enrollmentId }}" name="grade1-{{ $student->subject }}-{{ $student->enrollmentId }}" onkeypress="return isNumberKey(event)" value="{{ $student->first_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid2 gradeInput" id="grade2-{{ $student->subject }}-{{ $student->enrollmentId }}" name="grade2-{{ $student->subject }}-{{ $student->enrollmentId }}" onkeypress="return isNumberKey(event)" value="{{ $student->second_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid3 gradeInput" id="grade3-{{ $student->subject }}-{{ $student->enrollmentId }}" name="grade3-{{ $student->subject }}-{{ $student->enrollmentId }}" onkeypress="return isNumberKey(event)" value="{{ $student->third_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGrid4 gradeInput" id="grade4-{{ $student->subject }}-{{ $student->enrollmentId }}" name="grade4-{{ $student->subject }}-{{ $student->enrollmentId }}" onkeypress="return isNumberKey(event)" value="{{ $student->fourth_grading }}" readonly></td>
                                    <td><input type="text" size="5" class="inputGridf gradeInput" id="gradef-{{ $student->subject }}-{{ $student->enrollmentId }}" name="gradef-{{ $student->subject }}-{{ $student->enrollmentId }}" onkeypress="return isNumberKey(event)" value="{{ $student->final_grading }}" readonly></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td><button type="button" class="btn-sm btn-primary mr-2 modalUpdate" id="btn-grade1" name="btn-grade1" data-toggle="modal" data-target="#modalSave" data-whatever="@getbootstrap" value="inputGrid1">Save</button></td>
                                <td><button type="button" class="btn-sm btn-primary mr-2 modalUpdate" id="btn-grade2" name="btn-grade2" data-toggle="modal" data-target="#modalSave" data-whatever="@getbootstrap" value="inputGrid2">Save</button></td>
                                <td><button type="button" class="btn-sm btn-primary mr-2 modalUpdate" id="btn-grade3" name="btn-grade3" data-toggle="modal" data-target="#modalSave" data-whatever="@getbootstrap" value="inputGrid3">Save</button></td>
                                <td><button type="button" class="btn-sm btn-primary mr-2 modalUpdate" id="btn-grade4" name="btn-grade4" data-toggle="modal" data-target="#modalSave" data-whatever="@getbootstrap" value="inputGrid4">Save</button></td>
                                <td><button type="button" class="btn-sm btn-primary mr-2 modalUpdate" id="btn-gradef" name="btn-gradef" data-toggle="modal" data-target="#modalSave" data-whatever="@getbootstrap" value="inputGridf">Save</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </font>
                </div>

                    @else
                        <h4>No Records Found...</h4>
                    @endif
                    
                
            </div>
        </div>
    </div>
</div>


<!-- update grade Modal -->
<div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="modalSaveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-info" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSaveTitle">Save Setails</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('registrar.student.updateGrades') }}">
            @csrf
            <input type="hidden" name="save_details_summary" id="save_details_summary">
            <input type="hidden" name="save_details_schoolyear" id="save_details_schoolyear">
            <input type="hidden" name="save_details_grade" id="save_details_grade">
            <input type="hidden" name="save_details_section" id="save_details_section">
            <input type="hidden" name="save_details_subject" id="save_details_subject">


            <div class="my-2 mx-2">
                <div class="alert alert-info" role="alert">
                    <h5>Are you sure you want to proceed?.</h5>
                </div>
            </div>
          <div class="row mx-3 ">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn-sm btn-info">Save</button>
            </div>
        </form>
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
        
        jQuery('#section').change(function(e){
            e.preventDefault();
            getSubjects($('#school_year').val() +"|"+ $('#grade').val()+"|"+ $('#section').val());
        });

        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($('#school_year').val() +"|"+ $('#grade').val());
        });

        jQuery('#school_year').change(function(e){
            e.preventDefault();
            getGrade($(this).val());
        });

        $('#btn-update').show();
        $('#btn-done').hide();

        $('.inputGrid1').prop('readOnly', true);
        $('.inputGrid2').prop('readOnly', true);
        $('.inputGrid3').prop('readOnly', true);
        $('.inputGrid4').prop('readOnly', true);
        $('.inputGridf').prop('readOnly', true);

        $('#btn-grade1').hide();
        $('#btn-grade2').hide();
        $('#btn-grade3').hide();
        $('#btn-grade4').hide();
        $('#btn-gradef').hide();

        $('#save_details_schoolyear').val("");
        $("#save_details_grade").val("");
        $("#save_details_section").val("");
        $("#save_details_subject").val("");
        $('#save_details-summary').val("");
        

        $('#btn-update').click(function() {
            $('#btn-update').hide();
            $('#btn-done').show();

            $('.inputGrid1').prop('readOnly', false);
            $('.inputGrid2').prop('readOnly', false);
            $('.inputGrid3').prop('readOnly', false);
            $('.inputGrid4').prop('readOnly', false);
            $('.inputGridf').prop('readOnly', false);

            $('#btn-grade1').show();
            $('#btn-grade2').show();
            $('#btn-grade3').show();
            $('#btn-grade4').show();
            $('#btn-gradef').show();
        });

        $('#btn-done').click(function() {
            $('#btn-update').show();
            $('#btn-done').hide();

            $('.inputGrid1').prop('readOnly', true);
            $('.inputGrid2').prop('readOnly', true);
            $('.inputGrid3').prop('readOnly', true);
            $('.inputGrid4').prop('readOnly', true);
            $('.inputGridf').prop('readOnly', true);

            $('#btn-grade1').hide();
            $('#btn-grade2').hide();
            $('#btn-grade3').hide();
            $('#btn-grade4').hide();
            $('#btn-gradef').hide();
        });

        var max_chars = 2;

        $('.gradeInput').keydown( function(e){
            if ($(this).val().length >= max_chars) { 
                $(this).val($(this).val().substr(0, max_chars));
            }
        });

        $('.gradeInput').keyup( function(e){
            if ($(this).val().length >= max_chars) { 
                $(this).val($(this).val().substr(0, max_chars));
            }
        });

        $('.modalUpdate').click(function() {
            var allInput = $( $("."+$(this).val()) );
            var inputLength = allInput.length;

            var name = "";
            var value = "";

            var inputSummary = "";

            for(var i=0; i < inputLength; i++){
                name = allInput[i]['name'];
                value = allInput[i]['value'];
                //console.log(name);

                var item = name.split("-");

                inputSummary += "|" + $(this).val() + "~" + item[2] + "~" + value;
            }
            
            $('#save_details_summary').val(inputSummary);
        });

        $('#modalSave').on('shown.coreui.modal', function (e) {
            //$(this).val()save-details-schoolyear
            $('#save_details_schoolyear').val($('#school_year_data').val());
            $("#save_details_grade").val($("#grade_data").val());
            $("#save_details_section").val($("#section_data").val());
            $("#save_details_subject").val($("#subject_data").val());
        });

    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function getSubjects($dataVal){
        var data = $dataVal;
                if(data) {
                    $.ajax({
                    url: '/ajax/subject/'+data,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="subject"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="subject"]').append('<option value="'+ value +'">'+ value +'</option>');
                    });
                }
            });
        }else{
            $('select[name="section"]').empty();
        }
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
                        $.each(data, function(key, value) {
                            if(key == 0){
                                getSubjects($('#school_year').val() + "|" + $('#grade').val() + "|" +  value['section']);
                            }
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
        }else{
            $('select[name="grade"]').empty();
        }  
    }

    function getActiveSchYear(){
        var currentYear = '2022';
        var d = new Date();
        var currentYear = d.getFullYear();
        var dataYear = "";
        @isset($requestData)
            dataYear = "{{ $requestData->school_year }}";
        @endisset

        $("#school_year option").each(function()
        {
            if(dataYear != ''){
                $('#school_year').val(dataYear).change();
            }else{
                // Add $(this).val() to your list
                $item = $(this).val().split("-");
                if($item[0] == currentYear){
                    $('#school_year').val($(this).val()).change();
                    //console.log('test');
                }
            }
            
        });
    }
</script>
@endsection