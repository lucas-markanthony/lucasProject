<!-- enroll student Modal -->
<div class="modal fade" id="modalEnroll" tabindex="-1" role="dialog" aria-labelledby="modalEnrollTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-success" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEnrollTitle">Enroll Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('registrar.student.enroll') }}">
            @csrf
            <input type="hidden" name="lrn" id="lrn" @isset($student) value="{{ $student->lrn }}" @endisset>
            <div class="my-2 mx-2">
                <div class="alert alert-success" role="alert">
                    <h5>By doing this action the current school year enrolled will be replaced.</h5> 
                    <h5>Please select new parameters below:</h5>
                </div>
            </div>
            <div class="input-group mx-3 my-3">
              <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text">Payment Scheme</span></div>
                  <div class="col-md-9">
                      <select class="form-control" id="new_payment_profile" name="new_payment_profile">
                      <option value="0">Please select</option>
                      @foreach ($paymentProfiles as $paymentProfile)
                          <option value="{{ $paymentProfile->id }}">{{ $paymentProfile->name }}</option>
                      @endforeach
                      </select>
                  </div>
              </div>
          </div>

          <div class="row mx-3 ">
            <div class="form-group col-sm-3">
                <label for="school-year">School Year</label><span class="text-danger"> *</span>
                <select class="form-control" id="new_school_year" name="new_school_year">
                    @foreach ($schoolyears as $schoolyear)
                        <option value="{{ $schoolyear->schoolyear }}">{{ $schoolyear->schoolyear }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-2">
                <label for="grade">Grade</label><span class="text-danger"> *</span>
                <select class="form-control" id="new_grade" name="new_grade">
                    @foreach ($gradeList as $grade)
                        <option value="{{ $grade->grade }}">{{ $grade->grade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-3">
                <label for="section">Section</label><span class="text-danger"> *</span>
                <select class="form-control" id="new_section" name="new_section">
                </select>
            </div>
        </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Enroll</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- drop student Modal -->
<div class="modal fade" id="modalDrop" tabindex="-1" role="dialog" aria-labelledby="modalDropTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-danger" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDropTitle">Drop Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('registrar.student.updateStatus') }}">
            @csrf
            <input type="hidden" name="lrn" id="lrn" @isset($student) value="{{ $student->lrn }}" @endisset>
            <input type="hidden" name="status" id="status" value="DROPPED">
            <div class="my-2 mx-2">
                <div class="alert alert-info" role="alert">
                    <h5>By doing this action the Student in the current school year enrolled will be set to <span class="badge badge-danger">DROPPED</span>.</h5>
                    <h5>Are you sure you want to proceed?.</h5>
                </div>
            </div>
          <div class="row mx-3 ">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Drop</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- fail student Modal -->
<div class="modal fade" id="modalFail" tabindex="-1" role="dialog" aria-labelledby="modalFailTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dark" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFailTitle">Fail Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('registrar.student.updateStatus') }}">
          @csrf
          <input type="hidden" name="lrn" id="lrn" @isset($student) value="{{ $student->lrn }}" @endisset>
          <input type="hidden" name="status" id="status" value="FAILED">
          <div class="my-2 mx-2">
              <div class="alert alert-info" role="alert">
                  <h5>By doing this action the Student in the current school year enrolled will be set to <span class="badge badge-dark">FAILED</span>.</h5>
                  <h5>Are you sure you want to proceed?.</h5>
              </div>
          </div>
        <div class="row mx-3 ">
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark">Fail</button>
          </div>
      </form>
    </div>
  </div>
</div>


<!-- complete student Modal -->
<div class="modal fade" id="modalComplete" tabindex="-1" role="dialog" aria-labelledby="modalCompleteTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCompleteTitle">Complete Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('registrar.student.updateStatus') }}">
          @csrf
          <input type="hidden" name="lrn" id="lrn" @isset($student) value="{{ $student->lrn }}" @endisset>
          <input type="hidden" name="status" id="status" value="COMPLETED">
          <div class="my-2 mx-2">
              <div class="alert alert-info" role="alert">
                  <h5>By doing this action the Student in the current school year enrolled will be set to <span class="badge badge-info">COMPLETED</span>.</h5>
                  <h5>Are you sure you want to proceed?.</h5>
              </div>
          </div>
        <div class="row mx-3 ">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Complete</button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- graduate student Modal -->
<div class="modal fade" id="modalGraduate" tabindex="-1" role="dialog" aria-labelledby="modalGraduateTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-info" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalGraduateTitle">Graduate Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('registrar.student.graduate') }}">
          @csrf
          <input type="hidden" name="lrn" id="lrn" @isset($student) value="{{ $student->lrn }}" @endisset>
          <input type="hidden" name="status" id="status" value="COMPLETED">
          <div class="my-2 mx-2">
              <div class="alert alert-info" role="alert">
                  <h5 class="text-justify">By doing this action the Student in the current school year enrolled will be set to <span class="badge badge-light">GRADUATED</span>.</h5>
                  <h5 class="text-justify">Also you will not be able to do any actions for this Student after this action.</h5>
                  <h5 class="text-justify">Are you sure you want to proceed?.</h5>
              </div>
          </div>
        <div class="row mx-3 ">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Graduate</button>
          </div>
      </form>
    </div>
  </div>
</div>


<!-- update student details Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateTitle" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUpdateTitle">Update Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('registrar.student.update', $student->lrn) }}">
          @method('PATCH')
          @csrf
            <input type="hidden" name="lrn" id="lrn" value="{{ $student->lrn }}">
            <div class="my-2 mx-2">
                <div class="alert alert-primary" role="alert">
                    <h5>Kindly verify input before proceeding</h5>
                </div>
            </div>
            <div>
              <div class="my-2 mx-2">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">LRN</span></div>
                        <input class="form-control" id="new_lrn" type="text" name="new_lrn" readonly>
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">grade</span></div>
                      <input class="form-control" id="new_gradeInput" type="text" name="new_gradeInput" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">section</span></div>
                      <input class="form-control" id="new_sectionInput" type="text" name="new_sectionInput" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">First Name</span></div>
                      <input class="form-control" id="new_first_name" type="text" name="new_first_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Last Name</span></div>
                      <input class="form-control" id="new_last_name" type="text" name="new_last_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Middle Name</span></div>
                      <input class="form-control" id="new_middle_name" type="text" name="new_middle_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Extention Name</span></div>
                      <input class="form-control" id="new_ext_name" type="text" name="new_ext_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Age</span></div>
                      <input class="form-control" id="new_age" type="text" name="new_age" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Gender</span></div>
                      <input class="form-control" id="new_gender" type="text" name="new_gender" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Birth Date</span></div>
                      <input class="form-control" id="new_dob" type="text" name="new_dob" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">EMAIL</span></div>
                      <input class="form-control" id="new_email" type="text" name="new_email" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Contact Number</span></div>
                      <input class="form-control" id="new_contact_number" type="text" name="new_contact_number" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">House Number & Street</span></div>
                      <input class="form-control" id="new_address_house" type="text" name="new_address_house" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Subdivision/Barangay</span></div>
                      <input class="form-control" id="new_address_barangay" type="text" name="new_address_barangay" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">City/Municipality</span></div>
                      <input class="form-control" id="new_address_city" type="text" name="new_address_city" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Postal/ZipCode</span></div>
                      <input class="form-control" id="new_postal" type="text" name="new_postal" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Province</span></div>
                      <input class="form-control" id="new_address_province" type="text" name="new_address_province" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Country</span></div>
                      <input class="form-control" id="new_address_country" type="text" name="new_address_country" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Father's Name</span></div>
                      <input class="form-control" id="new_father_name" type="text" name="new_father_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                      <input class="form-control" id="new_father_occupation" type="text" name="new_father_occupation" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Contact No.</span></div>
                      <input class="form-control" id="new_father_contact" type="text" name="new_father_contact" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Mother's Name</span></div>
                      <input class="form-control" id="new_mother_name" type="text" name="new_mother_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                      <input class="form-control" id="new_mother_occupation" type="text" name="new_mother_occupation" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Contact No.</span></div>
                      <input class="form-control" id="new_mother_contact" type="text" name="new_mother_contact" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Guardian's Name</span></div>
                      <input class="form-control" id="new_guardian_name" type="text" name="new_guardian_name" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Occupation</span></div>
                      <input class="form-control" id="new_guardian_occupation" type="text" name="new_guardian_occupation" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Contact No.</span></div>
                      <input class="form-control" id="new_guardian_contact" type="text" name="new_guardian_contact" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Elementary School Name</span></div>
                      <input class="form-control" id="new_elemtary_school" type="text" name="new_elemtary_school" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Elementary School Year</span></div>
                      <input class="form-control" id="new_elementary_schoolyr" type="text" name="new_elementary_schoolyr" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">Elementary School Address</span></div>
                      <input class="form-control" id="new_elementary_school_address" type="text" name="new_elementary_school_address" readonly>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
      </div>
    </div>
</div>