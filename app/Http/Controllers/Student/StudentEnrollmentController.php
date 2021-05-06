<?php

namespace App\Http\Controllers\Student;

use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use PDF;

class StudentEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Models\StudentEnrollment  $studentEnrollment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentEnrollment $studentEnrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentEnrollment  $studentEnrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentEnrollment $studentEnrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentEnrollment  $studentEnrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentEnrollment $studentEnrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentEnrollment  $studentEnrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentEnrollment $studentEnrollment)
    {
        //
    }

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

        return $pdf->download('Registration_Form_' . $id . '.pdf');

    }
}
