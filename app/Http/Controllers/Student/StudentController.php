<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use App\Models\paymentScheme;
use App\Models\StudentPayment;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\LoggingController;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $gradedata = DB::table('gradeSection')
        ->select('grade')->distinct()->get(['grade']);

        return view('student.register', [
            'paymentProfiles' => paymentScheme::all(),
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    public function studentRecordIndex()
    {
        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW STUDENT RECORDS MENU', '');

        return view('student.studentRecords', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear'])
        ]);
    }

    public function studentClassRecordIndex()
    {
        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW CLASS RECORDS MENU', '');

        return view('student.studentClassRecords', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear'])
        ]);
    }

    public function searchClass(Request $request)
    {

        $classRecords = DB::table('students')
                ->join('student_enrollments', 'students.id', '=', 'student_enrollments.studentId')
                ->join('student_records', 'student_enrollments.id', '=', 'student_records.enrollmentId')
                ->where('student_enrollments.school_year', $request->school_year)
                ->where('student_enrollments.grade', $request->grade)
                ->where('student_enrollments.section', $request->section)
                ->where('student_records.subject', $request->subject)
                ->orderBy('students.gender', 'asc')
                ->orderBy('students.last_name', 'asc')
                ->orderBy('students.first_name', 'asc')->get();

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'SEARCH CLASS RECORDS', '');

        return view('student.studentClassRecords', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'classrecords' => $classRecords,
            'school_year' => $request->school_year,
            'grade' => $request->grade,
            'section' => $request->section,
            'subject' => $request->subject
        ]);

    }

    public function searchStudentRecord(Request $request)
    {

       $studentDetails = DB::table('students')
            ->join('student_enrollments', 'students.id', '=', 'student_enrollments.studentId')
            ->where('student_enrollments.school_year', $request->school_year)
            ->select('student_enrollments.id', 'students.lrn', 'students.first_name', 
            'students.last_name', 'students.middle_name', 'students.ext_name', 'student_enrollments.grade', 
            'student_enrollments.school_year', 'student_enrollments.section', 'students.gender')
            ->where('students.lrn', $request->text_input)->first();

        $studentRecords = DB::table('student_records')
            ->where('enrollmentId', $studentDetails->id)->get();
        
        //dd($studentRecords);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'SEARCH STUDENT RECORDS', '');

        return view('student.studentRecords', [
            'studentdetails' => $studentDetails,
            'studentrecords' => $studentRecords,
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear'])
        ]);

    }

    public function updateGrades(Request $request)
    {

        $inputGrade = $request->save_details_summary;
        $enrollmentID = "";
        $grade = "";

        $gradeList = explode('|', $inputGrade);

        for($i=1; $i < count($gradeList); $i++){
            $item = explode('~', $gradeList[$i]);
            $quarter = $item[0];
            $enrollmentID = $item[1];
            $grade = $item[2];
            $quarterStatus = "";
            
            $affected = DB::table('student_records')
                ->where('enrollmentId', $enrollmentID)
                ->where('subject', $request->save_details_subject);

            switch ($quarter) {
                case "inputGrid1":
                    $affected->update([
                        'first_grading' => $grade,
                        'first_grading_status' => "UPDATED",
                        'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
                case "inputGrid2":
                    $affected->update([
                        'second_grading' => $grade,
                        'second_grading_status' => "UPDATED",
                        'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
                case "inputGrid3":
                    $affected->update([
                        'third_grading' => $grade,
                        'third_grading_status' => "UPDATED",
                        'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
                case "inputGrid4":
                    $affected->update([
                        'fourth_grading' => $grade,
                        'fourth_grading_status' => "UPDATED",
                        'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
                default:
                    $affected->update([
                        'final_grading' => $grade,
                        'final_grading_status' => "UPDATED",
                        'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
            } 
        }

        $request->session()->flash('success', 'You have successfully Updated Student');

        $classRecords = DB::table('students')
                ->join('student_enrollments', 'students.id', '=', 'student_enrollments.studentId')
                ->join('student_records', 'student_enrollments.id', '=', 'student_records.enrollmentId')
                ->where('student_enrollments.school_year', $request->save_details_schoolyear)
                ->where('student_enrollments.grade', $request->save_details_grade)
                ->where('student_enrollments.section', $request->save_details_section)
                ->where('student_records.subject', $request->save_details_subject)
                ->orderBy('students.gender', 'asc')
                ->orderBy('students.last_name', 'asc')
                ->orderBy('students.first_name', 'asc')->get();

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'UPDATE GRADES', '');

        return view('student.studentClassRecords', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'classrecords' => $classRecords,
            'school_year' => $request->save_details_schoolyear,
            'grade' => $request->save_details_grade,
            'section' => $request->save_details_section,
            'subject' => $request->save_details_subject
        ]);

    }

    public function create()
    {
        $gradedata = DB::table('gradeSection')
        ->select('grade')->distinct()->get(['grade']);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW SEARCH STUDENT MENU', '');

        return view('student.search', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    public function store(Request $request)
    {
        //Input Validation
        $validated = $request->validate([
            'school_year' => 'required',
            'grade' => 'required',
            'section' => 'required',
            'lrn' => 'required|unique:students|max:13',
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'payment_profile' => 'required',
        ]);

        $response = false;
        $gradedata = DB::table('gradeSection')
            ->select('grade')->distinct()->get(['grade']);

        $elemSchoolYear="";
        if($request->elementary_schoolyr_to != null){
            $elemSchoolYear = $request->elementary_schoolyr_to ."-". $request->elementary_schoolyr_from;
        }

        if($request->payment_profile == 0){
            $request->session()->flash('error', 'Please select payment scheme');
            return view('student.register', [
                'paymentProfiles' => paymentScheme::all(),
                'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
                'gradeList' => $gradedata
            ]);
        }

        //Insert Data to Students table
        $newStudent = new Student;
            $newStudent->lrn = $request->lrn;
            $newStudent->first_name = $request->first_name;
            $newStudent->last_name = $request->last_name;
            $newStudent->middle_name = $request->middle_name;
            $newStudent->ext_name = $request->ext_name;
            $newStudent->age = $request->age;
            $newStudent->gender = $request->gender;
            $newStudent->dob = $request->date_input;
            $newStudent->contact_no = $request->contact_number;
            $newStudent->email = $request->email;
            $newStudent->street = $request->address_house;
            $newStudent->barangay = $request->address_barangay;
            $newStudent->city = $request->address_city;
            $newStudent->province = $request->address_province;
            $newStudent->country = $request->address_country;
            $newStudent->postal = $request->postal;
            $newStudent->father_name = $request->father_name;
            $newStudent->father_occupation = $request->father_occupation;
            $newStudent->father_contact = $request->father_contact;
            $newStudent->mother_name = $request->mother_name;
            $newStudent->mother_occupation = $request->mother_occupation;
            $newStudent->mother_contact = $request->mother_contact;
            $newStudent->guardian_name = $request->guardian_name;
            $newStudent->guardian_occupation = $request->guardian_occupation;
            $newStudent->guardian_contact = $request->guardian_contact;
            $newStudent->e_schoolname = $request->elementary_school;
            $newStudent->e_schoolyr = $elemSchoolYear;
            $newStudent->e_address = $request->elementary_school_address;
            $newStudent->save();


            //Create Enrollment status StudentEnrollment
            $student = Student::where('lrn', $request->lrn)->first();
            $paymentschemes = paymentScheme::where('id', $request->payment_profile)->first();

            $newEnroll = new StudentEnrollment;

            $newEnroll->school_year = $request->school_year;
            $newEnroll->grade = $request->grade;
            $newEnroll->section = $request->section;
            $newEnroll->studentId = $student->id;
            $newEnroll->schemeID =  $paymentschemes->name;
            $newEnroll->enrollment_status = 'ENROLLED';
            $newEnroll->save();

            //Create Payment record
            $enrollment = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();
            

            foreach($paymentschemes->fees['fees'] as $payment){

                $newPayment = new StudentPayment;
                $newPayment->studentId = $student->id;
                $newPayment->enrollmentId = $enrollment->id;

                $newPayment->feeName = $payment['feeName'];
                $newPayment->fullAmout = $payment['fullAmount'];
                $newPayment->balance = $payment['fullAmount'];
                $newPayment->save();
            }

            //Create Academic record
            $subjectGroupName = DB::table('gradeSection')
            ->select('subjectgroup')
            ->where('schoolyear', $enrollment->school_year)
            ->where('grade', $enrollment->grade)
            ->where('section', $enrollment->section)->first();

            $subjectGroup = DB::table('subjectGroup')
            ->where('name', $subjectGroupName->subjectgroup)->first();

            $subjects = explode('|', $subjectGroup->subjectgroup);

            for($i=0; $i < count($subjects); $i++){
                $response = $this->insertStudentRecordContainer($student->id, $enrollment->id, $subjects[$i]);
            }

            //send email to new student

            $logger = new LoggingController;
            $logger->storeHistory(Auth::user()->id, 'STUDENT REGISTRATION', $request->lrn);

            $request->session()->flash('success', 'You have successfully Registered New Student');

            return view('student.register', [
                'paymentProfiles' => paymentScheme::all(),
                'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
                'gradeList' => $gradedata
            ]);
    }

    private function insertStudentRecordContainer($studentId, $enrollmentId, $subject){
            $response1 = false;

            $response1 = DB::table('student_records')->insert([
                ['studentId' => $studentId, 
                'enrollmentId' => $enrollmentId, 
                'subject' => $subject,
                'created_at' => Carbon::now('Asia/Manila')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString() ]

            ]);

            return $response1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::where('lrn', $id)->first();
        $gradedata = DB::table('gradeSection')
            ->select('grade')->distinct()->get(['grade']);

        if($student != null){
            $enrollment = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();
            $enrollmentHistory = DB::table('student_enrollments')
                ->join('students', 'students.id', '=', 'student_enrollments.studentId')
                ->select('lrn', 'school_year','grade','section','enrollment_status')
                ->where('student_enrollments.studentId', $student->id)
                ->orderBy('student_enrollments.created_at', 'asc')->paginate(10);

                $remainingBalance = DB::table('student_payments')
                    ->leftjoin('student_enrollments', 'student_enrollments.id', '=', 'student_payments.enrollmentId')
                    ->select('student_enrollments.school_year', 'student_payments.feeName',
                            'student_payments.fullAmout','student_payments.balance')
                    ->where('student_enrollments.studentId', $student->id)
                    ->orderBy('student_payments.created_at', 'asc')->get();

                $txnHistory = DB::table('payment_transactions')
                    ->where('payment_transactions.lrn', $id)
                    ->orderBy('payment_transactions.id', 'desc')->take(10)->get();

                $payments = StudentPayment::where('studentId', $student->id)->orderBy('created_at', 'asc')->get();

                $logger = new LoggingController;
                $logger->storeHistory(Auth::user()->id, 'SHOW STUDENT DETAILS', $id);

                return view('student.viewStudent', [
                    'student' => $student,
                    'studentEnrollment' => $enrollment,
                    'studentPayment' => $payments,
                    'enrollmentHistory' => $enrollmentHistory,
                    'remainingBalance' => $remainingBalance,
                    'paymentProfiles' => paymentScheme::all(),
                    'transactionHistory' => $txnHistory,
                    'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
                    'gradeList' => $gradedata
                ]);
        }else{
            return view('student.search', [
                'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
                'gradeList' => $gradedata
            ]);
        }
    }


    public function searchRecord(Request $request, Student $student)
    {
        $gradedata = DB::table('gradeSection')
            ->select('grade')->distinct()->get(['grade']);
            
        $query = DB::table('student_enrollments')
        ->join('students', 'students.id', '=', 'student_enrollments.studentId')
        ->select('lrn', 'first_name','last_name','middle_name','ext_name',
            'school_year','grade','section','enrollment_status');

            if($request->input_type == 'lrn' && $request->text_input != ''){
                $enrollmentId = '0';
                $currentenroll;

                $student = Student::where('lrn', $request->text_input)->first();
                if($student != null){
                    $currentenroll = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();
                    $enrollmentId = $currentenroll->id;
                }
                
                $query->where('students.lrn', '=', $request->text_input)
                ->where('student_enrollments.id', '=', $enrollmentId);
            }else{
                $query->where('student_enrollments.school_year', '=', $request->school_year);

                if($request->section != 'all'){
                    $query->where('student_enrollments.section', '=', $request->section);
                }
                if($request->grade != 'all'){
                    $query->where('student_enrollments.grade', '=', $request->grade);
                }
                if($request->lname != ''){
                    $query->where('students.last_name', '=', $request->text_input);
                }

                
            }

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'SHOW STUDENT DETAILS MENU', '');

        
            $students = $query->get();
        return view('student.search', [
            'searchResult' => $students,
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    public function enroll(Request $request, Student $student)
    {
        $strcount = strlen($request->new_grade);

        //dd($strcount);
        $student = Student::where('lrn', $request->lrn)->first();
        $EnrollmentHistory = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->get();
        $currentenroll = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();


        if($request->new_payment_profile == 0){
            $request->session()->flash('error', 'Please select payment scheme');
            return redirect(route('registrar.student.show', $request->lrn));
        }

        foreach($EnrollmentHistory as $enrollments){
            if($enrollments->school_year == $request->new_school_year && $strcount <= 2){
                $request->session()->flash('error', 'This Student already enrolled with this school year: ' . $request->new_school_year);
                return redirect(route('registrar.student.show', $request->lrn));
            }
        } 

        //update previous enrollment status
        if($currentenroll->enrollment_status == "ENROLLED"){
            $affected = DB::table('student_enrollments')
              ->where('id', $currentenroll->id)
              ->update(['enrollment_status' => 'COMPLETED',
              'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()]);
        }

        $paymentschemes = paymentScheme::where('id', $request->new_payment_profile)->first();

        //Create Enrollment status StudentEnrollment
        $newEnroll = new StudentEnrollment;

        $newEnroll->school_year = $request->new_school_year;
        $newEnroll->grade = $request->new_grade;
        $newEnroll->section = $request->new_section;
        $newEnroll->studentId = $student->id;
        $newEnroll->schemeID =  $paymentschemes->name;
        $newEnroll->enrollment_status = 'ENROLLED';
        $newEnroll->save();

        $enrollment = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();

        //Create Payment record
        foreach($paymentschemes->fees['fees'] as $payment){

            $newPayment = new StudentPayment;
            $newPayment->studentId = $student->id;
            $newPayment->enrollmentId = $enrollment->id;

            $newPayment->feeName = $payment['feeName'];
            $newPayment->fullAmout = $payment['fullAmount'];
            $newPayment->balance = $payment['fullAmount'];
            $newPayment->save();
        }

        //send email to new student
        //generate PDF file - registration form
        //

        //Create Academic record
        $subjectGroupName = DB::table('gradeSection')
        ->select('subjectgroup')
        ->where('schoolyear', $enrollment->school_year)
        ->where('grade', $enrollment->grade)
        ->where('section', $enrollment->section)->first();

        $subjectGroup = DB::table('subjectGroup')
        ->where('name', $subjectGroupName->subjectgroup)->first();

        $subjects = explode('|', $subjectGroup->subjectgroup);

        for($i=0; $i < count($subjects); $i++){
            $response = $this->insertStudentRecordContainer($student->id, $enrollment->id, $subjects[$i]);
        }

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'STUDENT ENROLLMENT', 'You have successfully Enrolled Student');

        $request->session()->flash('success', 'You have successfully Enrolled Student');
        return redirect(route('registrar.student.show', $request->lrn));
    }

    public function updateStatus(Request $request, Student $student)
    {
        $student = Student::where('lrn', $request->lrn)->first();

        $currentenroll = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();

        switch ($request->status) {
            case "COMPLETED":
                $affected = DB::table('student_enrollments')
                    ->where('id', $currentenroll->id)
                    ->update(['enrollment_status' => 'COMPLETED',
                    'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
            case "FAILED":
                $affected = DB::table('student_enrollments')
                    ->where('id', $currentenroll->id)
                    ->update(['enrollment_status' => 'FAILED',
                    'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
                break;
            case "DROPPED":
                $affected = DB::table('student_enrollments')
                    ->where('id', $currentenroll->id)
                    ->update(['enrollment_status' => 'DROPPED',
                    'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                    ]);
            break;
            default:
                $request->session()->flash('error', 'The student is not Enrolled');
        }    

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'UPDATE STUDENT STATUS DETAIL', 'You have successfully Updated Student Status');

        $request->session()->flash('success', 'You have successfully Updated Student Status');
        return redirect(route('registrar.student.show', $request->lrn));
    }

    public function graduate(Request $request, Student $student)
    {
        //dd($request);
        $student = Student::where('lrn', $request->lrn)->first();
        $currentenroll = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();


        if($currentenroll->enrollment_status != 'ENROLLED'){
            $request->session()->flash('error', 'The student is not allowed to Graduate: not Enrolled');
            return redirect(route('registrar.student.show', $request->lrn));
        }

        $remainingBalance = DB::table('student_payments')
                    ->select('student_payments.feeName','student_payments.fullAmout','student_payments.balance')
                    ->where('student_payments.studentId', $student->id)->get();

        $remainingBalanceAmount = 0;
        
        foreach($remainingBalance as $balance){
            $remainingBalanceAmount += $balance->balance;
        }

        if($remainingBalanceAmount > 0){
            $request->session()->flash('error', 'The student is still have pending payments');
            return redirect(route('registrar.student.show', $request->lrn));
        }

        $affected = DB::table('student_enrollments')
            ->where('id', $currentenroll->id)
            ->update(['enrollment_status' => 'GRADUATED',
            'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
            ]);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'GRADUATE STUDENT', 'You have successfully Updated Student Status');

        $request->session()->flash('success', 'You have successfully Updated Student Status');
        return redirect(route('registrar.student.show', $request->lrn));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        //Input Validation
        $validated = $request->validate([
            'new_gradeInput' => 'required',
            'new_sectionInput' => 'required',
            'new_last_name' => 'required|max:255',
            'new_first_name' => 'required|max:255',
            'new_dob' => 'required',
            'new_email' => 'required|max:255',
            'new_contact_number' => 'required',
        ]);

        $lrnSearch = DB::table('students')
        ->where('lrn', $request->new_lrn)->get();

        $lrncount = $lrnSearch->count();

        if($lrncount > 0 && $request->lrn != $request->new_lrn){
            $request->session()->flash('error', 'LRN already exist');
            return redirect(route('registrar.student.show', $request->lrn));
        }
        
        $student = Student::where('lrn', $request->lrn)->first();
        $currentenroll = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();

        $updateStudent = DB::table('students')
            ->where('lrn', $request->lrn)
            ->update([
                'lrn' => $request->new_lrn,
                'first_name' => $request->new_first_name,
                'last_name' => $request->new_last_name,
                'middle_name' => $request->new_middle_name,
                'ext_name' => $request->new_ext_name,
                'age' => $request->new_age,
                'gender' => $request->new_gender,
                'dob' => $request->new_dob,
                'email' => $request->new_email,
                'contact_no' => $request->new_contact_number,
                'street' => $request->new_address_house,
                'barangay' => $request->new_address_barangay,
                'city' => $request->new_address_city,
                'postal' => $request->new_postal,
                'province' => $request->new_address_province,
                'country' => $request->new_address_country,
                'father_name' => $request->new_father_name,
                'father_occupation' => $request->new_father_occupation,
                'father_contact' => $request->new_father_contact,
                'mother_name' => $request->new_mother_name,
                'mother_occupation' => $request->new_mother_occupation,
                'mother_contact' => $request->new_mother_contact,
                'guardian_name' => $request->new_guardian_name,
                'guardian_occupation' => $request->new_guardian_occupation,
                'guardian_contact' => $request->new_guardian_contact,
                'e_schoolname' => $request->new_elemtary_school,
                'e_schoolyr' => $request->new_elementary_schoolyr,
                'e_address' => $request->new_elementary_school_address,
                'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
                
            ]);    

        $updateStudent = DB::table('student_enrollments')
            ->where('id', $currentenroll->id)
            ->update([
                'grade' => $request->new_gradeInput,
                'section' => $request->new_sectionInput,
                'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()
            ]);

            $logger = new LoggingController;
            $logger->storeHistory(Auth::user()->id, 'UPDATE STUDENT STATUS DETAIL', 'You have successfully Updated Student Information');

        $request->session()->flash('success', 'You have successfully Updated Student Information');
        return redirect(route('registrar.student.show', $request->lrn));
    }


}
