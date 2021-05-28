@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h5>School Year List</h5></div>
                <div class="card-body">
                    @isset($schoolyears)
                        
                        @foreach($schoolyears as $schoolyear)
                            <span class="badge badge-info h6">{{ $schoolyear->schoolyear }}</span>
                        @endforeach

                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header"><h5>New School Year Setup</h5></div>
                <div class="card-body">
    
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">School Year</span></div>
                            <input class="form-control" id="schoolyr_to" type="text" name="schoolyr_to" placeholder="YYYY" maxlength="4" onkeypress="return isNumberKey(event)">
                            <p class="px-1">_</p>
                            <input class="form-control" id="schoolyr_from" type="text" name="schoolyr_from" placeholder="YYYY" maxlength="4" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
    
                    <button class="btn btn-primary float-right" type="button" id="schNext">Next</button>
    
                </div>
            </div>
    
            <div class="card" id="gradeSection" style="display: none">
                <div class="card-header"><h5>Grade-Section Setup</h5></div>
                <div class="card-body">
    
                    <div class="form-group row">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Grade</span></div>
                                <input class="form-control" id="grade" type="text" name="grade" placeholder="XX" maxlength="3">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Section</span></div>
                                <input class="form-control" id="section" type="text" name="section" placeholder="Section">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label for="school-year">Subject Group</label><span class="text-danger"> *</span>
                        <select class="form-control" id="subjectgrp" name="subjectgrp">
                            @foreach ($subjectGroups as $subjectGroup)
                                <option value="{{ $subjectGroup->name }}">{{ $subjectGroup->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary float-right" type="button" id="addSection" name="addSection">Add</button>
                </div>
            </div>
        
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header"><h5 id="summaryTabHeader">Summary</h5></div>
                <div class="card-body">
                    <font size="1">
                    <table class="table" id="summaryTable" style="width: 100%">
                        <thead>
                            <th>Grade</th>
                            <th>Section</th>
                            <th>Subject Group</th>
                        </thead>

                        <tbody>
                        </tbody>       
                    </table>
                    </font>

                    <div class="mb-2 h4" id="subject" name="subject">
                    </div>
                    <form method="POST" action="{{ route('admin.schoolYear.addNewSchoolYearConfig') }}">
                        @csrf
                        <input type="hidden" id="schoolYear" name="schoolYear">
                        <input type="hidden" id="summary" name="summary">
                    
                    
                        <button type="submit" class="btn btn-info btn-lg btn-block" id="submit" name="submit">Save Configuration</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection


@section('third_party_scripts')
<script type="text/javascript">

    jQuery(document).ready(function(){
        
        $("#schNext").show();
        $("#schoolyr_to").prop('readOnly', false);
        $("#schoolyr_from").prop('readOnly', false);
        $("#summary").val("");
        $("#schoolYear").val("");


        $("#schNext").on("click", function() {  
            //gradeSection
            var schTo = $("#schoolyr_to").val();
            var schFrom = $("#schoolyr_from").val();

            if(schTo == '' || schFrom == ''){
                alert('Please check input');
            }else{
                $('#summaryTabHeader').text('Summary for School Year '+schTo+'-'+schFrom+':');
                $('#schoolYear').val(schTo+'-'+schFrom);
                $('#gradeSection').toggle("slide");
                $("#schoolyr_to").prop('readOnly', true);
                $("#schoolyr_from").prop('readOnly', true);
                $("#schNext").hide();
            }
            
        });

        $("#addSection").on("click", function() {  
            var schTo = $("#schoolyr_to").val();
            var schFrom = $("#schoolyr_from").val();
            var grade = $("#grade").val();
            var section = $("#section").val();
            var subjectgrp = $("#subjectgrp").val();
            var summary = $("#summary").val();
            var finalString =  "|"+grade+"~"+section+"~"+subjectgrp; 
            var isPass = 0;

            var summary = $("#summary").val();

            if(grade == '' || section == ''){
                alert('Section already used');
            }else{
                if(summary !=""){
                    var res = summary.split("|");

                    //$("#subject").append("<span class=\"badge badge-secondary mr-2\">" +finalString+ "</span>");  
                    var inputLength = res.length;
                    for(var i=1; i < inputLength; i++){
                        var items = res[i].split("~");

                        if(items[1] == section){
                            isPass++;
                        }
                    }

                    if(isPass!=0){
                        alert('Please check input test');
                    }else{
                        summary += "|"+grade+"~"+section+"~"+subjectgrp; 
                        $("#summary").val(summary);
                        $('#summaryTable > tbody:last-child').append('<tr><td>'+grade+'</td><td>'+section+'</td><td>'+subjectgrp+'</td></tr>');
                    }
                }else{
                    $("#summary").val(finalString);
                    $('#summaryTable > tbody:last-child').append('<tr><td>'+grade+'</td><td>'+section+'</td><td>'+subjectgrp+'</td></tr>');
                }
                $("#grade").val("");
                $("#section").val("");
            }
        });  

        $("#section").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            if ($(this).val().match(/[ ]/g, "") != null) {
                $(this).val($(this).val().replace(/[ ]/g, "_"));
            }
        });

        $("#grade").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    

    //32 space _95
    function isWhiteSpace(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        var strInput = $("#name").val();
        var strNewInput = $("#name").val();
        
        //if (charCode == 32){
        //    strNewInput =  strInput.replace(/\s+/g, ''); 
        //}

        //console.log(evt.target['value']);
        console.log(evt.target['id']);
        $("#"+evt.target['id']).val('test');
        //$("#" + evt.target['name']).val('test');

        //$("#" + evt.target['id']).val(strNewInput);
        //    return false;
        //return true;
        //name.replace(/\s/g, '') 
    }

    </script>
@endsection
