@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('registrar.student.store') }}">
    @csrf
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Registration</strong> <small>Form</small></div>
            <div class="card-body">
                
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="school-year">School Year</label><span class="text-danger"> *</span>
                        <select class="form-control" id="school_year" name="school_year" value="{{ old('school_year') }}">
                            @foreach ($schoolyears as $schoolyear)
                                <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="grade">Grade</label><span class="text-danger"> *</span>
                        <select class="form-control" id="grade" name="grade" value="{{ old('grade') }}">
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="section">Section</label><span class="text-danger"> *</span>
                        <select class="form-control" id="section" name="section" value="{{ old('section') }}">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">LRN<strong class="text-danger">*</strong></span></div>
                        <input class="form-control" id="lrn" type="text" name="lrn" placeholder="Lerner's reference number" maxlength="13" onkeypress="return isNumberKey(event)" value="{{ old('lrn') }}">
                        @error('lrn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Student Information</strong> <small>Form</small></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Last Name <strong class="text-danger">*</strong></span></div>
                        <input class="form-control toUpperCase" id="last_name" type="text" name="last_name" placeholder="Last Name" maxlength="50" value="{{ old('last_name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">First Name<strong class="text-danger">*</strong></span></div>
                        <input class="form-control toUpperCase" id="first_name" type="text" name="first_name" placeholder="First Name" maxlength="50" value="{{ old('first_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Middle Name<strong class="text-danger">*</strong></span></div>
                        <input class="form-control toUpperCase" id="middle_name" type="text" name="middle_name" placeholder="Middle Name" maxlength="50" value="{{ old('middle_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Extension Name</span></div>
                        <input class="form-control toUpperCase" id="ext_name" type="text" name="ext_name" placeholder="Extension Name" maxlength="25" value="{{ old('ext_name') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Age</span></div>
                            <input class="form-control" id="age" type="text" name="age" placeholder="Age" maxlength="2" onkeypress="return isNumberKey(event)"  value="{{ old('age') }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend pr-3"><span class="input-group-text">Gender<strong class="text-danger">*</strong></span></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-1" value="Male" checked="true">
                                <label class="form-check-label" for="gender-1">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-2" value="Female">
                                <label class="form-check-label" for="gender-2">Female</label>
                              </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Birthdate<strong class="text-danger">*</strong></span></div>
                            <input class="form-control" id="date_input" type="date" name="date_input" placeholder="date" value="{{ old('date_input') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">EMAIL</span></div>
                            <input class="form-control" id="email" type="text" name="email" placeholder="example@test.com" maxlength="50" value="{{ old('email') }}">
                            <span class="input-group-text">
                                <i class="cil-envelope-open"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="contact_number" type="text" name="contact_number" placeholder="Contact Number" maxlength="13" onkeypress="return isNumberKey(event)" value="{{ old('contact_number') }}">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Permanent Home Address</strong> <small>Form</small></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">House Number & Street</span></div>
                        <input class="form-control toUpperCase" id="address_house" type="text" name="address_house" placeholder="House number and street" maxlength="50" value="{{ old('address_house') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Subdivision/Barangay</span></div>
                        <input class="form-control toUpperCase" id="address_barangay" type="text" name="address_barangay" placeholder="Subdivision / Barangay" maxlength="50" value="{{ old('address_barangay') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">City/Municipality</span></div>
                            <input class="form-control toUpperCase" id="address_city" type="text" name="address_city" placeholder="City / Municipality" maxlength="50" value="{{ old('address_city') }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Postal/ZipCode</span></div>
                            <input class="form-control" id="postal" type="text" name="postal" placeholder="Postal / Zip Code" maxlength="6" onkeypress="return isNumberKey(event)" value="{{ old('postal') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Province</span></div>
                            <input class="form-control toUpperCase" id="address_province" type="text" name="address_province" placeholder="Province" maxlength="50" value="{{ old('address_province') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Country</span></div>
                            <input class="form-control toUpperCase" id="address_country" type="text" name="address_country" placeholder="Country" maxlength="50" value="{{ old('address_country') }}">
                        </div>
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Parent/s or Guardian Infomation</strong> <small>Form</small></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Father's Name</span></div>
                        <input class="form-control toUpperCase" id="father_name" type="text" name="father_name" placeholder="Last name, First name, Middle name" maxlength="50" value="{{ old('father_name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control toUpperCase" id="father_occupation" type="text" name="father_occupation" placeholder="Father's Occupation" maxlength="50" value="{{ old('father_occupation') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="father_contact" type="text" name="father_contact" placeholder="Father's Contact number" maxlength="13" onkeypress="return isNumberKey(event)" value="{{ old('father_contact') }}">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Mother's Name</span></div>
                        <input class="form-control toUpperCase" id="mother_name" type="text" name="mother_name" placeholder="Last name, First name, Middle name" maxlength="50" value="{{ old('mother_name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control toUpperCase" id="mother_occupation" type="text" name="mother_occupation" placeholder="Mother's Occupation" maxlength="50" value="{{ old('mother_occupation') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="mother_contact" type="text" name="mother_contact" placeholder="Mother's Contact number" maxlength="13" onkeypress="return isNumberKey(event)" value="{{ old('mother_contact') }}">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Guardian's Name</span></div>
                        <input class="form-control toUpperCase" id="guardian_name" type="text" name="guardian_name" placeholder="Last name, First name, Middle name" maxlength="50" value="{{ old('guardian_name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control toUpperCase" id="guardian_occupation" type="text" name="guardian_occupation" placeholder="Guardian's Occupation" maxlength="50" value="{{ old('guardian_occupation') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="guardian_contact" type="text" name="guardian_contact" placeholder="Guardian's Contact number" maxlength="13" onkeypress="return isNumberKey(event)" value="{{ old('guardian_contact') }}">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Elementary School Data</strong> <small>Form</small></div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Elementary School Name</span></div>
                            <input class="form-control toUpperCase" id="elemtary_school" type="text" name="elementary_school" placeholder="Elementary School Name" maxlength="100" value="{{ old('elementary_school') }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Elementary School Year</span></div>
                            <input class="form-control" id="elementary_schoolyr_to" type="text" name="elementary_schoolyr_to" placeholder="YYYY" maxlength="4" onkeypress="return isNumberKey(event)" value="{{ old('elementary_schoolyr_to') }}">
                            <p class="px-1">_</p>
                            <input class="form-control" id="elementary_schoolyr_from" type="text" name="elementary_schoolyr_from" placeholder="YYYY" maxlength="4" onkeypress="return isNumberKey(event)" value="{{ old('elementary_schoolyr_from') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Elementary School Address</span></div>
                        <input class="form-control toUpperCase" id="elementary_school_address" type="text" name="elementary_school_address" placeholder="Address" maxlength="100" value="{{ old('elementary_school_address') }}">
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Set Payment and Submit</strong> <small>Form</small></div>
            <div class="card-body"> 
                <div class="input-group mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Payment Scheme</span></div>
                        <div class="col-md-9">
                            <select class="form-control" id="payment_profile" name="payment_profile">
                            <option value="0">Please select</option>
                            @foreach ($paymentProfiles as $paymentProfile)
                                <option value="{{ $paymentProfile->id }}">{{ $paymentProfile->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info btn-lg btn-block" type="submit">Register Student</button>
            </div> 
        </div>
    </div>
</div>
</form>
@endsection

@section('third_party_scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
        getActiveSchYear()

        getGrade($('#school_year').val());

        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($('#school_year').val() +"|"+ $('#grade').val());
        });

        jQuery('#school_year').change(function(e){
            e.preventDefault();
            getGrade($(this).val());
        });

        $(".toUpperCase").keyup(function() {
            $(this).val($(this).val().toUpperCase());
            if ($(this).val().match(/[ ]/g, "") != null) {
                $(this).val($(this).val().replace(/[ ]/g, "_"));
            }
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
        $data1 = "";
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

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
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