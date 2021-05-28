@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><h3>View: {{ $student->lrn }}</h3></div>
            <div class="card-body">
                <div class="col-md-12 mb-4">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#student_info" role="tab" aria-controls="student_info" aria-selected="true">Student Information</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add_info" role="tab" aria-controls="add_info" aria-selected="false">Additional Information</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#enrollment" role="tab" aria-controls="enrollment" aria-selected="false">Enrollment</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#balance" role="tab" aria-controls="balance" aria-selected="false">Balance</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#txn_history" role="tab" aria-controls="txn_history" aria-selected="false">Transaciton History</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="student_info" role="tabpanel">
                                @include('student.partials.studentInfo')
                            </div>
                            <div class="tab-pane" id="add_info" role="tabpanel">
                                @include('student.partials.addInfo')
                            </div>
                            <div class="tab-pane" id="enrollment" role="tabpanel">
                                @include('student.partials.enrollmentData')
                            </div>
                            <div class="tab-pane" id="balance" role="tabpanel">
                                @include('student.partials.balance')
                            </div>
                            <div class="tab-pane" id="txn_history" role="tabpanel">
                                @include('student.partials.txnHistory')
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</div>

@include('student.partials.modals')

@endsection

@section('third_party_scripts')
<script type="text/javascript">

    jQuery(document).ready(function(){

        var eschoolYear = "{{ $studentEnrollment->school_year }}";
        var egrade = "{{ $studentEnrollment->grade }}";
        var esection = "{{ $studentEnrollment->section }}";
        var egender = "{{ $student->gender }}";
        var estatus = "{{ $studentEnrollment->enrollment_status }}";

        if(egender != $("#gender-1").val()){
            $("#gender-1").attr('checked', '');
            $("#gender-2").attr('checked', 'checked');
        }else{
            $("#gender-2").attr('checked', '');
            $("#gender-1").attr('checked', 'checked');
        }

        $('#save').hide();
        $('#cancel').hide();
        $('#update').show();
        showStatusButtons(estatus,egrade);

        $('.updateinput').prop('readOnly', true);
        $('.inputDisable').prop('disabled', true);    

        getGrade(eschoolYear, egrade);
        getSection(eschoolYear+"|"+egrade, esection);

        $('#school_year').val(eschoolYear).change();
        $('#grade').val(egrade).change();
        $('#section').val(esection).change();

        $('#new_school_year').val(eschoolYear).change();
        $('#new_grade').val(egrade).change();
        $('#new_section').val(esection).change();

        
        

        jQuery('#school_year').change(function(e){
            e.preventDefault();
            getGrade($(this).val(), egrade);
        });

        jQuery('#new_school_year').change(function(e){
            e.preventDefault();
            getNewGrade($(this).val());
        });

        getNewSection($('#new_school_year').val()+"|"+$('#new_grade').val(), esection);
        
        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($('#school_year').val() + "|" + $(this).val(), esection);
        });

        jQuery('#new_grade').change(function(e){
            e.preventDefault();
            getNewSection($('#new_school_year').val() + "|" + $(this).val(), esection);
        });


        $('#update').click(function() {
            $('#save').show();
            $('#cancel').show();
            $('#update').hide();
            showStatusButtons('HIDE',egrade);

            $('.updateinput').prop('readOnly', false);
            $('.inputDisable').prop('disabled', false);
        });

        $('#cancel').click(function() {
            $('#save').hide();
            $('#cancel').hide();
            $('#update').show();
            showStatusButtons(estatus,egrade);

            $('.updateinput').prop('readOnly', true);
            $('.inputDisable').prop('disabled', true);
        });


        $('#modalUpdate').on('shown.coreui.modal', function (e) {
            //console.log($('#address_country').val());
            var newGradeValue = $('#grade option:selected').text();
            var newSectionValue = $('#section option:selected').text();
            var newDOBValue = $("#date_input1").val();
            var newGenderValue = $('input[name="gender"]:checked').val();

            $("#new_lrn").val($('#lrn').val());
            $("#new_gradeInput").val(newGradeValue);
            $("#new_sectionInput").val(newSectionValue);
            $("#new_first_name").val($('#first_name').val());
            $("#new_last_name").val($('#last_name').val());
            $("#new_middle_name").val($('#middle_name').val());
            $("#new_ext_name").val($('#ext_name').val());
            $("#new_age").val($('#age').val());
            $("#new_gender").val(newGenderValue);
            $("#new_dob").val(newDOBValue);
            $("#new_email").val($('#email').val());
            $("#new_contact_number").val($('#contact_number').val());
            $("#new_address_house").val($('#address_house').val());
            $("#new_address_barangay").val($('#address_barangay').val());
            $("#new_address_city").val($('#address_city').val());
            $("#new_postal").val($('#postal').val());
            $("#new_address_province").val($('#address_province').val());
            $("#new_address_country").val($('#address_country').val());
            $("#new_father_name").val($('#father_name').val());
            $("#new_father_occupation").val($('#father_occupation').val());
            $("#new_father_contact").val($('#father_contact').val());
            $("#new_mother_name").val($('#mother_name').val());
            $("#new_mother_occupation").val($('#mother_occupation').val());
            $("#new_mother_contact").val($('#mother_contact').val());
            $("#new_guardian_name").val($('#guardian_name').val());
            $("#new_guardian_occupation").val($('#guardian_occupation').val());
            $("#new_guardian_contact").val($('#guardian_contact').val());
            $("#new_elemtary_school").val($('#elemtary_school').val());
            $("#new_elementary_schoolyr").val($('#elementary_schoolyr').val());
            $("#new_elementary_school_address").val($('#elementary_school_address').val());
        })


    });
        
    function exportfilePDF($lrn){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        $.ajax({
            url: '/registrar/export/registerFormExport/'+$lrn,
            type: "GET",
            success:function(response){
            
            },
            error: function(response) {
                }
            });
    }

    function getSection($gradeVal, $currentValue){
        var grade = $gradeVal;
                if(grade) {
                    $.ajax({
                    url: '/ajax/section/'+grade,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="section"]').empty();
                        $.each(data, function(key, value) {
                            if(value['section'] == $currentValue){
                                $('select[name="section"]').append('<option value="'+ value['section'] +'" selected>'+ value['section'] +'</option>');
                            }else{
                                $('select[name="section"]').append('<option value="'+ value['section'] +'">'+ value['section'] +'</option>');
                            }
                    });
                }
            });
            document.getElementById("section").innerHTML = $currentValue;
        }else{
            $('select[name="section"]').empty();
        }
    }

    function getGrade($dataVal, $currentValue){
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
                            if(value['grade'] == $currentValue){
                                $('select[name="grade"]').append('<option value="'+ value['grade'] +'" selected>'+ value['grade'] +'</option>');
                            }else{
                                $('select[name="grade"]').append('<option value="'+ value['grade'] +'">'+ value['grade'] +'</option>');
                            }
                        
                    });
                }
            });
            
            
        }else{
            $('select[name="grade"]').empty();
        }

        getSection($('#school_year').val() + "|" + $('#grade').val());
    }

    function getNewGrade($dataVal){
        var data = $dataVal;
        var data1 = "";
                if(data) {
                    $.ajax({
                    url: '/ajax/grade/'+data,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="new_grade"]').empty();
                        $.each(data, function(key, value) {
                        $('select[name="new_grade"]').append('<option value="'+ value['grade'] +'">'+ value['grade'] +'</option>');
                    });
                }
            });
            
            
        }else{
            $('select[name="new_grade"]').empty();
        }

        getNewSection($('#new_school_year').val() + "|7" );
    }

    function getNewSection($gradeVal){
        var grade = $gradeVal;
                if(grade) {
                    $.ajax({
                    url: '/ajax/section/'+grade,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="new_section"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="new_section"]').append('<option value="'+ value['section'] +'">'+ value['section'] +'</option>');
                    });
                }
            });
        }else{
            $('select[name="new_section"]').empty();
        }
    }

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function showStatusButtons($status, $grade){
        if($status == 'ENROLLED'){
            $('#enroll').hide();
            $('#drop').show();
            $('#fail').show();
            if($grade == '12' || $grade == '12b' || $grade == '12B'){
                $('#complete').hide();
                $('#graduate').show();
            }else{
                $('#complete').show();
                $('#graduate').hide();
            }
        }
        if($status == 'DROPPED'){
            $('#drop').hide();
            $('#fail').show();
            $('#enroll').show();
            if($grade == '12' || $grade == '12b' || $grade == '12B'){
                $('#complete').hide();
                $('#graduate').show();
            }else{
                $('#complete').show();
                $('#graduate').hide();
            }
        }
        if($status == 'COMPLETED'){
            $('#enroll').show();
            $('#drop').show();
            $('#complete').hide();
            $('#fail').show();
            $('#graduate').hide();
        }
        if($status == 'FAILED'){
            $('#drop').show();
            $('#fail').hide();
            $('#enroll').show();
            if($grade == '12' || $grade == '12b' || $grade == '12B'){
                $('#complete').hide();
                $('#graduate').show();
            }else{
                $('#complete').show();
                $('#graduate').hide();
            }
        }
        if($status == 'GRADUATED'){
            $('#drop').hide();
            $('#fail').hide();
            $('#enroll').hide();
            $('#complete').hide();
            $('#graduate').hide();
            $('#save').hide();
            $('#cancel').hide();
            $('#update').hide();
        }
        if($status == 'HIDE'){
            $('#enroll').hide();
            $('#drop').hide();
            $('#complete').hide();
            $('#fail').hide();
            $('#graduate').hide();
        }
    }

</script>
@endsection