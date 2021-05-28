<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now()->format('Y');
        $schoolyearList = DB::table('gradeSection')->distinct()->get(['schoolyear']);  

        $currentSchoolYear = DB::table('gradeSection')
        ->orderBy('schoolyear', 'desc')->distinct()->get(['schoolyear'])->first();


        if($currentSchoolYear == null){
            return view('home',[
                'isEmpty' => 'true'
            ]);
        }else{

        $studentCount = DB::table('student_enrollments')
            ->select(DB::raw('count(*) as studentCount'))
            ->where('school_year', '=', $currentSchoolYear->schoolyear)
            ->first();

        $studentsummary = DB::table('student_enrollments')
            ->select(DB::raw('count(*) as studentCount, enrollment_status, school_year'))
            ->where('school_year', '=', $currentSchoolYear->schoolyear)
            ->groupBy('enrollment_status')
            ->groupBy('school_year')
            ->get();

        $enrolled = 0;
        $completed = 0;
        $graduated = 0;
        $failed = 0;

        foreach($studentsummary as $status){
            switch ($status->enrollment_status) {
                case "ENROLLED":
                    $enrolled = $status->studentCount;
                break;
                case "COMPLETED":
                    $completed = $status->studentCount;
                break;
                case "GRADUATED":
                    $graduated = $status->studentCount;
                break;
                case "FAILED":
                case "DROPPED":
                    $failed = $status->studentCount;
                break;
            }
        
        }

        //dd($studentsummary);

        return view('home',[
            'isEmpty' => 'false',
            'schoolyears' => $schoolyearList,
            'currentSchoolYear' => $currentSchoolYear,
            'studentCount' => $studentCount,
            'enrolled' => $enrolled,
            'completed' => $completed,
            'graduated' => $graduated,
            'failed' => $failed
        ]);
            
        }
    }

    public function notfounderror()
    {
        return view('error.404');
    }

    public function servererror()
    {
        return view('error.500');
    }

    public function section($id)
    {
        $idData = explode('|', $id);
        $schoolyear = $idData[0];
        $grade = $idData[1];

        $sectionsdata = DB::table('gradeSection')
        ->where('schoolyear', '=', $schoolyear)
        ->where('grade', '=', $grade)
        ->select('section')->distinct()->get(['section']);
        return json_encode($sectionsdata);
    }

    public function grade($id)
    {
        $gradesdata = DB::table('gradeSection')
        ->where('schoolyear', '=', $id)
        ->select('grade')->distinct()->get(['grade']);

        return json_encode($gradesdata);
    }

    public function subject($id)
    {
        $idData = explode('|', $id);
        $schoolyear = $idData[0];
        $grade = $idData[1];
        $section = $idData[2];

        $subjectGroup = DB::table('gradeSection')
                ->join('subjectGroup', 'gradeSection.subjectgroup', '=', 'subjectGroup.name')
                ->select('subjectGroup.subjectgroup')
                ->where('.gradeSection.schoolyear', $schoolyear)
                ->where('.gradeSection.grade', $grade)
                ->where('.gradeSection.section', $section)
                ->first();


        $responseData = explode('|', $subjectGroup->subjectgroup);

        return json_encode($responseData);
    }
}
