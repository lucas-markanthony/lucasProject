<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">House Number & Street</span></div>
        <input class="form-control updateinput" id="address_house" type="text" name="address_house" placeholder="House number and street" @isset($student) value="{{ $student->street }}" @endisset readonly>
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Subdivision/Barangay</span></div>
        <input class="form-control updateinput" id="address_barangay" type="text" name="address_barangay" placeholder="Subdivision / Barangay" @isset($student) value="{{ $student->barangay }}" @endisset readonly>
    </div>
</div>

<div class="form-group row">
    <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">City/Municipality</span></div>
            <input class="form-control updateinput" id="address_city" type="text" name="address_city" placeholder="City / Municipality" @isset($student) value="{{ $student->city }}" @endisset readonly>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Postal/ZipCode</span></div>
            <input class="form-control updateinput" id="postal" type="text" name="postal" placeholder="Postal / Zip Code" @isset($student) value="{{ $student->postal }}" @endisset readonly>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Province</span></div>
            <input class="form-control updateinput" id="address_province" type="text" name="address_province" placeholder="Province" @isset($student) value="{{ $student->province }}" @endisset readonly>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Country</span></div>
            <input class="form-control updateinput" id="address_country" type="text" name="address_country" placeholder="Country" @isset($student) value="{{ $student->country }}" @endisset readonly>
        </div>
    </div>
</div>



<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Father's Name</span></div>
        <input class="form-control updateinput" id="father_name" type="text" name="father_name" placeholder="Last name, First name, Middle name" @isset($student) value="{{ $student->father_name }}" @endisset readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
            <input class="form-control updateinput" id="father_occupation" type="text" name="father_occupation" placeholder="Father's Occupation" @isset($student) value="{{ $student->father_occupation }}" @endisset readonly>
        </div>
    </div>
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
            <input class="form-control updateinput" id="father_contact" type="text" name="father_contact" placeholder="Father's Contact number" @isset($student) value="{{ $student->father_contact }}" @endisset readonly>
            <span class="input-group-text">
                <i class="cil-dialpad"></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Mother's Name</span></div>
        <input class="form-control updateinput" id="mother_name" type="text" name="mother_name" placeholder="Last name, First name, Middle name" @isset($student) value="{{ $student->mother_name }}" @endisset readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
            <input class="form-control updateinput" id="mother_occupation" type="text" name="mother_occupation" placeholder="Mother's Occupation" @isset($student) value="{{ $student->mother_occupation }}" @endisset readonly>
        </div>
    </div>
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
            <input class="form-control updateinput" id="mother_contact" type="text" name="mother_contact" placeholder="Mother's Contact number" @isset($student) value="{{ $student->mother_contact }}" @endisset readonly>
            <span class="input-group-text">
                <i class="cil-dialpad"></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Guardian's Name</span></div>
        <input class="form-control updateinput" id="guardian_name" type="text" name="guardian_name" placeholder="Last name, First name, Middle name" @isset($student) value="{{ $student->guardian_name }}" @endisset readonly>
    </div>
</div>
<div class="form-group row">
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
            <input class="form-control updateinput" id="guardian_occupation" type="text" name="guardian_occupation" placeholder="Guardian's Occupation" @isset($student) value="{{ $student->guardian_occupation }}" @endisset readonly>
        </div>
    </div>
    <div class="col-6">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
            <input class="form-control updateinput" id="guardian_contact" type="text" name="guardian_contact" placeholder="Guardian's Contact number" @isset($student) value="{{ $student->guardian_contact }}" @endisset readonly>
            <span class="input-group-text">
                <i class="cil-dialpad"></i>
            </span>
        </div>
    </div>
</div>



<div class="form-group row">
    <div class="col-8">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Elementary School Name</span></div>
            <input class="form-control updateinput" id="elemtary_school" type="text" name="elementary_school" placeholder="Elementary School Name" @isset($student) value="{{ $student->e_schoolname }}" @endisset readonly>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">Elementary School Year</span></div>
            <input class="form-control updateinput" id="elementary_schoolyr" type="text" name="elementary_schoolyr_to" placeholder="YYYY-YYYY" @isset($student) value="{{ $student->e_schoolyr }}" @endisset readonly>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Elementary School Address</span></div>
        <input class="form-control updateinput" id="elementary_school_address" type="text" name="elementary_school_address" placeholder="Address" @isset($student) value="{{ $student->e_address }}" @endisset readonly>
    </div>
</div>