@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"><h5>Subject Group List</h5></div>
                <div class="card-body">
                    @isset($subjectGroups)
                    @if (count($subjectGroups) >= 1)
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subjects</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($subjectGroups as $subjectGroup)
                            <tr>
                                <td>{{ $subjectGroup->name }}</td>
                                <td>{{ $subjectGroup->subjectgroup }}</td>
                                <td>test</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $subjectGroups->links() }}
                @else
                    <h3>No Records Found...</h3>
                @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header"><h5>New Subject Group Setup</h5></div>
                <div class="card-body">
    
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Name</span></div>
                            <input class="form-control toUpper" id="sbjgrp_name" type="text" name="sbjgrp_name" placeholder="Subject Group Name" maxlength="50">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"><span class="input-group-text">Subject</span></div>
                            <input class="form-control toUpper" id="subject_name" type="text" name="subject_name" placeholder="Subject Group Name" maxlength="50">
                        </div>
                    </div>
    
                    <button class="btn btn-primary float-right" type="button" id="sbjNext">Add</button>
    
                </div>
            </div>

        
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header"><h5 id="summaryTabHeader">Summary</h5></div>
                <div class="card-body">
                    
                    <table class="table" id="summaryTable" style="width: 100%">
                        <thead>
                            <th>Subject</th>
                        </thead>

                        <tbody>
                        </tbody>       
                    </table>

                    <div class="mb-2 h4" id="subject" name="subject">
                    </div>
                    <form method="POST" action="{{ route('admin.subjectGroup.addNewSubjectGroupConfig') }}">
                        @csrf
                        <input type="hidden" id="subectSummary" name="subectSummary">
                        <input type="hidden" id="subjectGroupName" name="subjectGroupName">
                    
                    
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
        $("#sbjgrp_name").prop('readOnly', false);

        
        $("#subectSummary").val("");
        $("#subjectGroupName").val("");
        $("#subject_name").val("");
        $("#sbjgrp_name").val("");


        $("#sbjNext").on("click", function() {  
            var subject = $("#subject_name").val();

            var subectSummary = $("#subectSummary").val();
            var finalString =  "|"+subject; 
            var isPass = 0;
            var summary = $("#subectSummary").val();

            if(subject == ''){
                alert('Please check input');
            }else{
                if(subectSummary !=""){
                    var res = subectSummary.split("|");

                    //$("#subject").append("<span class=\"badge badge-secondary mr-2\">" +finalString+ "</span>");  
                    var inputLength = res.length;
                    for(var i=1; i < inputLength; i++){
                        if(res[1] == subject){
                            isPass++;
                        }
                    }

                    if(isPass!=0){
                        alert('Please check input');
                    }else{
                        summary += "|"+subject; 
                        $("#subectSummary").val(summary);
                        $('#summaryTable > tbody:last-child').append('<tr><td>'+subject+'</td></tr>');
                    }
                }else{
                    $("#subectSummary").val(finalString);
                    $("#subjectGroupName").val($("#sbjgrp_name").val());
                    $("#sbjgrp_name").prop('readOnly', true);
                    $('#summaryTable > tbody:last-child').append('<tr><td>'+subject+'</td></tr>');
                }
                $("#subject_name").val("");
            }
        });  
        

        $(".toUpper").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            if ($(this).val().match(/[ ]/g, "") != null) {
                $(this).val($(this).val().replace(/[ ]/g, "_"));
            }
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
        
        console.log(evt.target['id']);
        $("#"+evt.target['id']).val('test');
    }

    </script>
@endsection
