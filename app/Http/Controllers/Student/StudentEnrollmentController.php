<?php

namespace App\Http\Controllers\Student;

use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use PDF;

use App\Http\Controllers\LoggingController;
use Illuminate\Support\Facades\Auth;

class StudentEnrollmentController extends Controller
{
    public function registerForm($id)
    {
        $student = Student::where('lrn', $id)->first();
        $enrollment = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();

        return view('export.registerForm', [
            'student' => $student,
            'studentEnrollment' => $enrollment
        ]);
    }

    public function testFormExport(){
        $pdf = PDF::loadview('export.testfile');

        return $pdf->download('Registration_Form.pdf');

    }

    public function registerFormExport($id){
        $student = Student::where('lrn', $id)->first();
        $enrollment = StudentEnrollment::where('studentId', $student->id)->orderBy('created_at', 'desc')->first();

        $pdf = PDF::loadview('export.registerForm',[
            'student' => $student,
            'studentEnrollment' => $enrollment
        ])
        ->setOption('dpi', 200)
        ->setOrientation('portrait')
        ->setOption('margin-bottom', 0)
        ->setPaper('a4');

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'EXPORT REGISTRATION FORM', '');

        return $pdf->download('Registration_Form_' . $id . '.pdf');

    }
}
