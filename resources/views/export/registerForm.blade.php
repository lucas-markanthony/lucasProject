<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/exportPDF.css') }}" crossorigin="anonymous">
</head>
<body>

    
<header>
    <div class="allborder">
        <table style="width:100%">
            <tr>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div class="float-right">
                                <img src="/var/www/html/Projects/lbmhsadmin/public/images/lbmhs_logo(250X250).png" width="100">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="float-left">
                                <p class="text-center h3 m-0">Luis Bernardo Memorial High School, Inc.</p>
                                <p class="text-center h6 m-0">Founded 22 May 1949 m SEC. Reg. No. 9414 (12/14/54)</p>
                                <p class="text-center h6 m-0">Gov't. Recog. No. 415(04/26/55), SHS Permit No. SHS-407, s. 2015</p>
                                <p class="text-center h6 m-0">Bala Street, Luisiana, Laguna. Tel/Fax No. (049-555-4447)</p>
                                <p class="text-center h6 m-0">Email Address: lbmhs_luisiana@yahoo.com</p>
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <div class="mt-5 mb-3">
                    <h4 class="text-center font-weight-bolder">JUNIOR HIGH SCHOOL REGISTRATION/ENROLLMENT FORM</h4>
                </div>
            </tr>
            <tr>
                <div class="container mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="school-year">School Year</label>
                            <input id="school_year" type="text" name="school_year" @isset($studentEnrollment) value="{{ $studentEnrollment->school_year }}" @endisset>
                        </div>
                        <div class="col">
                            <label for="grade">Grade</label>
                            <input id="grade" type="text" name="grade" @isset($studentEnrollment) value="{{ $studentEnrollment->grade }}" @endisset>
                        </div>
                        <div class="col">
                            <label for="section">Section</label>
                            <input id="section" type="text" name="section" @isset($studentEnrollment) value="{{ $studentEnrollment->section }}" @endisset>
                        </div>
                    </div>
                </div>
                
            </tr>
            <tr>
                <div class="container-fluid">
                    <div class="mb-3">
                        <h5 class="text-left font-weight-bolder">STUDENT INFORMATION</h5>
                    </div>
                    <div class="mx-4">
                        <div class="mb-2">
                            <div class="input-group">
                                <div class="mr-3">
                                    <h5 class="text-left">LEARNERS REFERENCE NUMBER (LRN)</h5>
                                </div>
                                <input class="form-control" id="lrn" type="text" name="lrn" @isset($studentEnrollment) value="{{ $student->lrn }}" @endisset>
                            </div>
                        </div>
                        <div class="mb-2">
                            <h5 class="text-left">NAME OF STUDENT</h5>
    
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Last Name</span></div>
                                    <input class="form-control" id="last_name" type="text" name="last_name" @isset($studentEnrollment) value="{{ $student->last_name }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">First Name</span></div>
                                    <input class="form-control" id="first_name" type="text" name="first_name" @isset($studentEnrollment) value="{{ $student->first_name }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Middle Name</span></div>
                                    <input class="form-control" id="middle_name" type="text" name="middle_name" @isset($studentEnrollment) value="{{ $student->middle_name }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Extension Name</span></div>
                                    <input class="form-control" id="ext_name" type="text" name="ext_name" @isset($studentEnrollment) value="{{ $student->ext_name }}" @endisset>
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <div class="col-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Age</span></div>
                                        <input class="form-control" id="age" type="text" name="age"  @isset($studentEnrollment) value="{{ $student->age }}" @endisset>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Gender</span></div>
                                            <input class="form-control" id="gender" type="text" name="gender" @isset($studentEnrollment) value="{{ $student->gender }}" @endisset>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Birthdate</span></div>
                                        <input class="form-control" id="date_input" type="text" name="date_input" @isset($studentEnrollment) value="{{ $student->dob }}" @endisset>
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group row">
                                <div class="col-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">EMAIL</span></div>
                                        <input class="form-control" id="email" type="text" name="email" @isset($studentEnrollment) value="{{ $student->email }}" @endisset>
                                        <span class="input-group-text">
                                            <i class="cil-envelope-open"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                                        <input class="form-control" id="contact_number" type="text" name="contact_number" @isset($studentEnrollment) value="{{ $student->contact_no }}" @endisset>
                                        <span class="input-group-text">
                                            <i class="cil-dialpad"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <h5 class="text-left">PERMANENT HOME ADDRESS</h5>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">House Number & Street</span></div>
                                    <input class="form-control" id="address_house" type="text" name="address_house" @isset($studentEnrollment) value="{{ $student->street }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Subdivision/Barangay</span></div>
                                    <input class="form-control" id="address_barangay" type="text" name="address_barangay" @isset($studentEnrollment) value="{{ $student->barangay }}" @endisset>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">City/Municipality</span></div>
                                        <input class="form-control" id="address_city" type="text" name="address_city" @isset($studentEnrollment) value="{{ $student->city }}" @endisset>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Postal/ZipCode</span></div>
                                        <input class="form-control" id="postal" type="text" name="postal" @isset($studentEnrollment) value="{{ $student->postal }}" @endisset>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Province</span></div>
                                        <input class="form-control" id="address_province" type="text" name="address_province" @isset($studentEnrollment) value="{{ $student->province }}" @endisset>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Country</span></div>
                                        <input class="form-control" id="address_country" type="text" name="address_country" @isset($studentEnrollment) value="{{ $student->country }}" @endisset>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    <div class="allborder my-3">
                        <div class="mx-2 my-3">
                            <div class="mt-3">
                                <h5 class="text-left font-weight-bolder">PARENT/S or GUARDIAN'S INFORMATION</h5>
                            </div>
                            <div class="mx-3">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Father's Name</span></div>
                                            <input class="form-control" id="father_name" type="text" name="father_name" @isset($studentEnrollment) value="{{ $student->father_name }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Mother's Name</span></div>
                                            <input class="form-control" id="mother_name" type="text" name="mother_name" @isset($studentEnrollment) value="{{ $student->mother_name }}" @endisset>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                                            <input class="form-control" id="father_occupation" type="text" name="father_occupation" @isset($studentEnrollment) value="{{ $student->father_occupation }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                                            <input class="form-control" id="father_contact" type="text" name="father_contact" @isset($studentEnrollment) value="{{ $student->father_contact }}" @endisset>
                                            <span class="input-group-text">
                                                <i class="cil-dialpad"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                                            <input class="form-control" id="mother_occupation" type="text" name="mother_occupation" @isset($studentEnrollment) value="{{ $student->mother_occupation }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                                            <input class="form-control" id="mother_contact" type="text" name="mother_contact" @isset($studentEnrollment) value="{{ $student->mother_occupation }}" @endisset>
                                            <span class="input-group-text">
                                                <i class="cil-dialpad"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                
                
                                <div class="form-group row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Guardian's Name</span></div>
                                            <input class="form-control" id="guardian_name" type="text" name="guardian_name" @isset($studentEnrollment) value="{{ $student->guardian_name }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                                            <input class="form-control" id="guardian_occupation" type="text" name="guardian_occupation" @isset($studentEnrollment) value="{{ $student->guardian_occupation }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Contact No</span></div>
                                            <input class="form-control" id="guardian_contact" type="text" name="guardian_contact" @isset($studentEnrollment) value="{{ $student->guardian_contact }}" @endisset>
                                            <span class="input-group-text">
                                                <i class="cil-dialpad"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="allborder mt-4">
                        <div class="mx-2">
                            <div class="mt-3">
                                <h5 class="text-left font-weight-bolder">ELEMENTARY SCHOOL DATA</h5>
                            </div>
                            
                            <div class="mx-3">
                                <div class="form-group row">
                                    <div class="col-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Elementary School Name</span></div>
                                            <input class="form-control" id="elemtary_school" type="text" name="elementary_school" @isset($studentEnrollment) value="{{ $student->e_schoolname }}" @endisset>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">Elementary School Year</span></div>
                                            <input class="form-control" id="elementary_schoolyr_to" type="text" name="elementary_schoolyr"  @isset($studentEnrollment) value="{{ $student->e_schoolyr }}" @endisset>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Elementary School Address</span></div>
                                        <input class="form-control" id="elementary_school_address" type="text" name="elementary_school_address"  @isset($studentEnrollment) value="{{ $student->e_address }}" @endisset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="allborder mb-3">
                        <div class="mx-4 my-4">
                            <p class="h5"><em>We understand that all information we provide in this form may be used by the School (LBMHS) and we consent to such with the assurance that personal details will be kept confidential</em></p>
                        </div>
                        <div class="mx-4 mt-5">
                            <div class="form-group row">
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Parent/Guardian <em>(Signiture Over Printed name)</em></p>
                                </div>
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Student <em>(Signiture Over Printed name)</em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="allborder">
                        <div class="mx-4 my-3">
                            <div class="form-group row mt-5">
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Class Adviser</p>
                                </div>
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Registrar</em></p>
                                </div>
                            </div>
                            
                            <div class="form-group row mt-5">
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Asst. Principal/Student Affairs Officer</em></p>
                                </div>
                                <div class="col-6">
                                    <p class="h5 text-center">_________________________________________________</p>
                                    <p class="h5 text-center">Administrator-Actg. Principal</em></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        </table> 
    </div>
</header>
   

</body>
</html>