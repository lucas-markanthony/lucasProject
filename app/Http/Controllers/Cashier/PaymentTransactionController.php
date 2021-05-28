<?php

namespace App\Http\Controllers\Cashier;

use App\Models\payment_transaction;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\paymentScheme;
use App\Models\StudentPayment;
use App\Models\StudentEnrollment;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\LoggingController;
use Illuminate\Support\Facades\Auth;

class PaymentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradedata = DB::table('gradeSection')
        ->select('grade')->distinct()->get(['grade']);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW CASHIER MENU', '');

        return view('cashier.search', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePayment(Request $request)
    {
        //dd($request);
        $status = "FAILED";
        $responseData;
        if($request->items == ""){
            $request->session()->flash('error', 'No payment selected');
            return redirect(route('cashier.student.show', $request->lrn_payment));
        }

        $payments = $request->items;
        $paymentList = explode('|', $payments);

        //dd($paymentList);

        for($i=1; $i < count($paymentList); $i++){
            $item = explode('~', $paymentList[$i]);
            $year = $item[0];
            $name = $item[1];
            $amount = $item[2];
            $enrollmentid = $item[3];

            $pay = $this->insertTransaction($request->lrn_payment, $year, $name, $amount, $request->receipt, $request->user, $enrollmentid);

            if($pay == false){
                $request->session()->flash('error', 'Payment Failed for ' . $name . "_" . $year);
                return redirect(route('cashier.student.show', $request->lrn_payment));
            }
        }

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'ADD STUDENT PAYMENT', $request->lrn_payment);
        
        $request->session()->flash('success', 'Payment Success');
        return redirect(route('cashier.student.show', $request->lrn_payment));
    }

    private function insertTransaction($lrn, $schoolYear, $name, $amount, $receiptNo, $user, $enrollmentid){
        $response = false;
        $enrollment;
        $newBalance;
        $paymentType = "PARTIAL";;
        
        $student = Student::where('lrn', $lrn)->first();
        if($student != null){
            $enrollment = StudentEnrollment::where('studentId', $student->id)
            ->where('school_year', $schoolYear)
            ->orderBy('created_at', 'desc')->first();
        }else{
            $response = false;
            return $response;
        }

        if($enrollment != null){
            $getCurrentBalance = DB::table('student_payments')
            ->where('enrollmentId', $enrollmentid)
                ->where('feeName', $name)
            ->first();

            $getBalance = $getCurrentBalance->balance;

            if($getBalance < $amount){
                $response = false;
                return $response;
            }
            if($getCurrentBalance->fullAmout == $amount){
                $paymentType = "FULL";
            }

            $newBalance = (int)$getBalance -  (int)$amount;
        }

            $affected = DB::table('student_payments')
                ->where('enrollmentId', $enrollmentid)
                ->where('feeName', $name)
                ->update(['balance' => $newBalance,
                'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString()]); 
                
                $fee = $enrollment->schemeID . "|" . $name;
                $this->insertTransactionRecord($lrn, $fee, $getCurrentBalance->fullAmout, $amount, 
                $paymentType, $newBalance, $receiptNo, $user, "SUCCESS");

            $response = true;   
            return $response;
    }

    private function insertTransactionRecord($lrn, $name, $fullAmount, 
        $amount, $payment, $remainingBalance, $receiptNo, $user, $status){
            $response1 = false;

            $response1 = DB::table('payment_transactions')->insert([
                ['lrn' => $lrn, 
                'scheme_name' => $name, 
                'payment' => $payment, 
                'full_amount' => $fullAmount,
                'amount' => $amount, 
                'remaining_balance' => $remainingBalance, 
                'receipt_number' => $receiptNo, 
                'cashier' => $user,
                'status' => $status,
                'created_at' => Carbon::now('Asia/Manila')->toDateTimeString(),
                'updated_at' => Carbon::now('Asia/Manila')->toDateTimeString() ]

            ]);

            return $response1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment_transaction  $payment_transaction
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
                ->orderBy('student_enrollments.created_at', 'asc');


                $remainingBalance = DB::table('student_payments')
                    ->leftjoin('student_enrollments', 'student_enrollments.id', '=', 'student_payments.enrollmentId')
                    ->select('student_enrollments.school_year', 'student_payments.feeName',
                            'student_payments.fullAmout','student_payments.balance', 'student_payments.enrollmentId')
                    ->where('student_enrollments.studentId', $student->id)
                    ->where('student_payments.balance', '!=', '0')
                    ->orderBy('student_payments.created_at', 'asc')->get();


                $schoolyears = DB::table('student_payments')
                    ->leftjoin('student_enrollments', 'student_enrollments.id', '=', 'student_payments.enrollmentId')
                    ->select('student_enrollments.school_year')
                    ->where('student_enrollments.studentId', $student->id)
                    ->where('student_payments.balance', '!=', '0')
                    ->orderBy('student_payments.created_at', 'asc');

                /*
                    select * from student_payments a left join student_enrollments b on b.id = a.enrollmentId where b.studentId = '1' and a.student_payments != '0'
                    order
                */

                $payments = StudentPayment::where('studentId', $student->id)->orderBy('created_at', 'asc')->get();

                //dd(DB::table('gradeSection')->distinct()->get(['schoolyear']));

                $logger = new LoggingController;
                $logger->storeHistory(Auth::user()->id, 'VIEW STUDENT PAYMENT MENU', $student->id);

                return view('cashier.student', [
                    'student' => $student,
                    'studentEnrollment' => $enrollment,
                    'studentPayment' => $payments,
                    'enrollmentHistory' => $enrollmentHistory->paginate(10),
                    'remainingBalance' => $remainingBalance,
                    'paymentProfiles' => paymentScheme::all(),
                    'schoolyears' => $schoolyears->distinct()->get(['school_year']),
                    'gradeList' => $gradedata
                ]);
        }else{
            $logger = new LoggingController;
            $logger->storeHistory(Auth::user()->id, 'VIEW STUDENT PAYMENT MENU', 'Student not found');

            $request->session()->flash('error', 'Student not found');
            return view('cashier.search', [
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

            $students = $query->get();

            $logger = new LoggingController;
            $logger->storeHistory(Auth::user()->id, 'SEARCH PAYMENT RECORDS', '');


        return view('cashier.search', [
            'searchResult' => $students,
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }
}
