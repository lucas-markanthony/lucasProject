<div class="float-right my-2">
    <button type="button" class="btn btn-primary mr-2" id="update" name="update">Update</button>

    <button type="button" class="btn btn-primary mr-2" id="save" name="save" data-toggle="modal" data-target="#modalUpdate" data-whatever="@getbootstrap" style="display:none">Save</button>
    <button type="button" class="btn btn-info mr-2" id="cancel" name="cancel" style="display:none">Cancel</button>

    <button type="button" class="btn btn-success mr-2" id="enroll" name="enroll"  data-toggle="modal" data-target="#modalEnroll" data-whatever="@getbootstrap" style="display:none">Enroll</button>
    <button type="button" class="btn btn-info mr-2" id="complete" name="complete" data-toggle="modal" data-target="#modalComplete" data-whatever="@getbootstrap">Complete</button>
    <button type="button" class="btn btn-light mr-2" id="graduate" name="graduate" data-toggle="modal" data-target="#modalGraduate" data-whatever="@getbootstrap">Graduate</button>
    <button type="button" class="btn btn-dark mr-2" id="fail" name="fail" data-toggle="modal" data-target="#modalFail" data-whatever="@getbootstrap">Fail</button>
    <button type="button" class="btn btn-danger mr-2" id="drop" name="drop" data-toggle="modal" data-target="#modalDrop" data-whatever="@getbootstrap">Drop</button>

    <button type="button" class="btn btn-info mr-2" onClick="event.preventDefault();
    document.getElementById('export-student-form-{{ $student->lrn }}').submit()">
        <span><i class="cib-adobe-acrobat-reader"></i></span>
        Export Form
    </button>

    <form id="export-student-form-{{ $student->lrn }}" action="{{ route('registrar.export.registerFormExport', $student->lrn) }}" method="GET" style="display: none">
        @csrf
        @method("GET")
    </form>
</div>
<div class="bottom">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">LRN<strong class="text-danger">*</strong></span></div>
            <input class="form-control updateinput" id="lrn" type="text" name="lrn" placeholder="Learner's reference number" @isset($student) value="{{ $student->lrn }}" @endisset maxlength="13" onkeypress="return isNumberKey(event)" readonly>
            @error('lrn')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-2">
            <label for="school-year">School Year</label><span class="text-danger"> *</span>
            <select class="form-control" id="school_year" name="school_year" @isset($student) value="{{ $studentEnrollment->school_year }}" @endisset disabled>
                @foreach ($schoolyears as $schoolyear)
                    <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-1">
            <label for="grade">Grade</label><span class="text-danger"> *</span>
            <select class="form-control inputDisable" id="grade" name="grade"@isset($student) value="{{ $studentEnrollment->grade }}" @endisset disabled>
                @foreach ($gradeList as $grade)
                    <option value="{{ $grade->grade }}">{{ $grade->grade }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-2">
            <label for="section">Section</label><span class="text-danger"> *</span>
            <select class="form-control inputDisable" id="section" name="section"  disabled>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <label>Status</label><span class="text-danger"> *</span>
            <div>
                @switch($studentEnrollment->enrollment_status)
                    @case('ENROLLED')
                        <h3><span class="badge badge-success">{{ $studentEnrollment->enrollment_status }}</span></h3>
                    @break
                    @case('COMPLETED')
                        <h3><span class="badge badge-info">{{ $studentEnrollment->enrollment_status }}</span></h3>
                    @break
                    @case('DROPPED')
                        <h3><span class="badge badge-danger">{{ $studentEnrollment->enrollment_status }}</span></h3>
                    @break
                    @case('GRADUATED')
                        <h3><span class="badge badge-light">{{ $studentEnrollment->enrollment_status }}</span></h3>
                    @break
                    @default
                        <h3><span class="badge badge-dark">{{ $studentEnrollment->enrollment_status }}</span></h3>
                @endswitch
            </div>
        </div>
        <div class="form-group col-sm-2">
            
        </div>
    </div>
</div>
<div class="mt-3 mb-3 bottom">
    <strong>Basic Information</strong>
</div>
<div id="inputgroup" name="inputgroup">
    <div class="my-2">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Last Name <strong class="text-danger">*</strong></span></div>
                <input class="form-control updateinput" id="last_name" type="text" name="last_name" placeholder="Last Name" @isset($student) value="{{ $student->last_name }}" maxlength="50" @endisset readonly>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">First Name<strong class="text-danger">*</strong></span></div>
                <input class="form-control updateinput" id="first_name" type="text" name="first_name" placeholder="First Name" @isset($student) value="{{ $student->first_name }}" maxlength="50" @endisset readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Middle Name<strong class="text-danger">*</strong></span></div>
                <input class="form-control updateinput" id="middle_name" type="text" name="middle_name" placeholder="Middle Name" @isset($student) value="{{ $student->middle_name }}" @endisset maxlength="50" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Extension Name</span></div>
                <input class="form-control updateinput" id="ext_name" type="text" name="ext_name" placeholder="Extension Name" @isset($student) value="{{ $student->ext_name }}" @endisset maxlength="25" readonly>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Age</span></div>
                    <input class="form-control updateinput" id="age" type="text" name="age" placeholder="Age" @isset($student) value="{{ $student->age }}" @endisset maxlength="2" onkeypress="return isNumberKey(event)" readonly>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend pr-3"><span class="input-group-text">Gender<strong class="text-danger">*</strong></span></div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input inputDisable" type="radio" name="gender" id="gender-1" value="Male">
                        <label class="form-check-label" for="gender-1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input inputDisable" type="radio" name="gender" id="gender-2" value="Female">
                        <label class="form-check-label" for="gender-2">Female</label>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Birthdate<strong class="text-danger">*</strong></span></div>
                    <input class="form-control updateinput inputDisable" id="date_input1" type="date" name="date_input1" placeholder="date"  @isset($student) value="{{ $student->dob }}" @endisset disabled>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">EMAIL</span></div>
                    <input class="form-control updateinput" id="email" type="text" name="email" placeholder="example@test.com" @isset($student) value="{{ $student->email }}" @endisset maxlength="50" readonly>
                    <span class="input-group-text">
                        <i class="cil-envelope-open"></i>
                    </span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                    <input class="form-control updateinput" id="contact_number" type="text" name="contact_number" placeholder="Contact Number" maxlength="13" onkeypress="return isNumberKey(event)" @isset($student) value="{{ $student->contact_no }}" @endisset readonly>
                    <span class="input-group-text">
                        <i class="cil-dialpad"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>