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
                        <select class="form-control" id="school_year" name="school_year">
                            @foreach ($schoolyears as $schoolyear)
                                <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="grade">Grade</label><span class="text-danger"> *</span>
                        <select class="form-control" id="grade" name="grade">
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
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">LRN<strong class="text-danger">*</strong></span></div>
                        <input class="form-control" id="lrn" type="text" name="lrn" placeholder="Lerner's reference number">
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
                        <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Last Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">First Name<strong class="text-danger">*</strong></span></div>
                        <input class="form-control" id="first_name" type="text" name="first_name" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Middle Name<strong class="text-danger">*</strong></span></div>
                        <input class="form-control" id="middle_name" type="text" name="middle_name" placeholder="Middle Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Extension Name</span></div>
                        <input class="form-control" id="ext_name" type="text" name="ext_name" placeholder="Extension Name">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-2">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Age</span></div>
                            <input class="form-control" id="age" type="text" name="age" placeholder="Age">
                        </div>
                    </div>
                    <div class="col-3">
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
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Birthdate<strong class="text-danger">*</strong></span></div>
                            <input class="form-control" id="date_input" type="date" name="date_input" placeholder="date">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">EMAIL</span></div>
                            <input class="form-control" id="email" type="text" name="email" placeholder="example@test.com">
                            <span class="input-group-text">
                                <i class="cil-envelope-open"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="contact_number" type="text" name="contact_number" placeholder="Contact Number">
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
                        <input class="form-control" id="address_house" type="text" name="address_house" placeholder="House number and street">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Subdivision/Barangay</span></div>
                        <input class="form-control" id="address_barangay" type="text" name="address_barangay" placeholder="Subdivision / Barangay">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">City/Municipality</span></div>
                            <input class="form-control" id="address_city" type="text" name="address_city" placeholder="City / Municipality">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Postal/ZipCode</span></div>
                            <input class="form-control" id="postal" type="text" name="postal" placeholder="Postal / Zip Code">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Province</span></div>
                            <input class="form-control" id="address_province" type="text" name="address_province" placeholder="Province">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Country</span></div>
                            <input class="form-control" id="address_country" type="text" name="address_country" placeholder="Country">
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
                        <input class="form-control" id="father_name" type="text" name="father_name" placeholder="Last name, First name, Middle name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control" id="father_occupation" type="text" name="father_occupation" placeholder="Father's Occupation">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="father_contact" type="text" name="father_contact" placeholder="Father's Contact number">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Mother's Name</span></div>
                        <input class="form-control" id="mother_name" type="text" name="mother_name" placeholder="Last name, First name, Middle name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control" id="mother_occupation" type="text" name="mother_occupation" placeholder="Mother's Occupation">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="mother_contact" type="text" name="mother_contact" placeholder="Mother's Contact number">
                            <span class="input-group-text">
                                <i class="cil-dialpad"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Guardian's Name</span></div>
                        <input class="form-control" id="guardian_name" type="text" name="guardian_name" placeholder="Last name, First name, Middle name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                            <input class="form-control" id="guardian_occupation" type="text" name="guardian_occupation" placeholder="Guardian's Occupation">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                            <input class="form-control" id="guardian_contact" type="text" name="guardian_contact" placeholder="Guardian's Contact number">
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
                            <input class="form-control" id="elemtary_school" type="text" name="elementary_school" placeholder="Elementary School Name">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Elementary School Year</span></div>
                            <input class="form-control" id="elementary_schoolyr_to" type="text" name="elementary_schoolyr_to" placeholder="YYYY">
                            <p class="px-1">_</p>
                            <input class="form-control" id="elementary_schoolyr_from" type="text" name="elementary_schoolyr_from" placeholder="YYYY">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">Elementary School Address</span></div>
                        <input class="form-control" id="elementary_school_address" type="text" name="elementary_school_address" placeholder="Address">
                    </div>
                </div>
                
            </div> 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header"><strong>Scanned Documents and Submit</strong> <small>Form</small></div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="col-md-9">
                        <input id="file-multiple-input" type="file" name="file-multiple-input" multiple="">
                    </div>
                </div>  
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
        getSection($('#grade').val());

        jQuery('#grade').change(function(e){
            e.preventDefault();
            getSection($(this).val());
        });
    });

    function getSection($gradeVal){
        var grade = $gradeVal;
                if(grade) {
                    $.ajax({
                    url: '/ajax/section/'+grade,
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
</script>
@endsection