<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\paymentScheme;
use App\Models\StudentPayment;
use App\Models\StudentEnrollment;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Reports extends Controller
{
    public function enrollmentRecordsIndex()
    {
        $gradedata = DB::table('gradeSection')
        ->select('grade')->distinct()->get(['grade']);

        return view('reports.enrollmentRecordsIndex', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function showSearchEnrollment(Request $request)
    {
        //dd($request);
        $gradedata = DB::table('gradeSection')
            ->select('grade')->distinct()->get(['grade']);
            
        $query = DB::table('student_enrollments')
            ->join('students', 'students.id', '=', 'student_enrollments.studentId')
            ->select('lrn', 'first_name','last_name','middle_name','ext_name', 'gender',
                'school_year','grade','section','enrollment_status');


        $query->where('student_enrollments.school_year', '=', $request->school_year);

        if($request->section != 'all'){
            $query->where('student_enrollments.section', '=', $request->section);
        }
        if($request->grade != 'all'){
            $query->where('student_enrollments.grade', '=', $request->grade);
        }

        $query->orderBy('student_enrollments.grade', 'asc');
        $query->orderBy('student_enrollments.section', 'asc');
        $query->orderBy('students.gender', $request->sort_gender);
        $query->orderBy('students.last_name', $request->sort_lname);
        $query->orderBy('students.first_name', 'asc');
        
        $students = $query->paginate(10);
        return view('reports.enrollmentRecordsIndex', [
            'searchResultData' => $students,
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    public function transactionRecordsIndex()
    {
        $gradedata = DB::table('gradeSection')
        ->select('grade')->distinct()->get(['grade']);
        
        return view('reports.transactionRecordsIndex', [
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
            'gradeList' => $gradedata
        ]);
    }

    
}
