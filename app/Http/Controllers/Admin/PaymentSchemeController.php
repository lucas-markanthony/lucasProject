<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\paymentScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class PaymentSchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.paymentScheme.index', [
            'paymentProfiles' => paymentScheme::all()
        ]);
    }


    public function schoolyearIndex()
    {
        $subjectGroup = DB::table('subjectGroup')->get();

        return view('admin.schoolYear.index', ['subjectGroups' => $subjectGroup,
            'schoolyears' =>  DB::table('gradeSection')->distinct()->get(['schoolyear']),
        ]);
    }

    public function subjectGroupIndex()
    {
        $subjectGroup = DB::table('subjectGroup')->paginate(10);

        return view('admin.subjectGroup.index', ['subjectGroups' => $subjectGroup]);
    }

    public function addNewSchoolYearConfig(Request $request)
    {
        //dd($request);
        $response = false;
        $subjectGroup = DB::table('subjectGroup')->get();

        $schoolYear = $request->schoolYear;
        $listGradeSection = $request->summary;
        $gradeSection = explode('|', $listGradeSection);

        $checkSchoolYear = DB::table('gradeSection')
            ->select('subjectgroup')
            ->where('schoolyear', $schoolYear)->first();

        if($checkSchoolYear != null || $checkSchoolYear != ''){
            $request->session()->flash('error', 'School year already configured');
            return view('admin.schoolYear.index', ['subjectGroups' => $subjectGroup]);
        }

        //dd($paymentList);

        for($i=1; $i < count($gradeSection); $i++){
            $item = explode('~', $gradeSection[$i]);
            $grade = $item[0];
            $section = $item[1];
            $subjectGroup1 = $item[2];

            $response = $this->insertConfig($schoolYear, $grade, $section, $subjectGroup1);
        }

        if($response == false){
            $request->session()->flash('error', 'Config failed');
            return view('admin.schoolYear.index', ['subjectGroups' => $subjectGroup]);
        }

        $request->session()->flash('success', 'Config success');
        return view('admin.schoolYear.index', ['subjectGroups' => $subjectGroup]);
    }

    public function addNewSubjectGroupConfig(Request $request)
    {
        //dd($request);
        $subjects = explode('|', $request->subectSummary);
        $finalString = "";
        $response1 = false;

        $checkGroupName = DB::table('subjectGroup')
            ->select('name')
            ->where('name', $request->subjectGroupName)->first();

        if($request->subectSummary == null || $checkGroupName == ''){
            $request->session()->flash('error', 'Configuration failed. Please try again');
            return view('admin.subjectGroup.index', []);
        }

        if($checkGroupName != null || $checkGroupName != ''){
            $request->session()->flash('error', 'Subject group name already configured');
            return view('admin.subjectGroup.index', []);
        }

        for($i=1; $i < count($subjects); $i++){
            
            if($i == 1){
                $finalString = $subjects[$i];
            }else{
                $finalString = $finalString . "|" . $subjects[$i];
            }
        }

        $response1 = DB::table('subjectGroup')->insert([
            'name' => $request->subjectGroupName, 
            'subjectgroup' => $finalString
        ]);

        if($response1 == true){
            $request->session()->flash('success', 'Config success');
            return view('admin.subjectGroup.index', []);
        }else{
            $request->session()->flash('error', 'Configuration failed. Please try again');
            return view('admin.subjectGroup.index', []);
        }
    }

    private function insertConfig($schoolyear, $grade, $section, $subjectgroup){
            $response1 = false;

            $response1 = DB::table('gradeSection')->insert([
                'schoolyear' => $schoolyear, 
                'grade' => $grade, 
                'section' => $section, 
                'subjectgroup' => $subjectgroup 
            ]);

            return $response1;
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
            $validated = $request->validate([
                'name' => 'required|unique:payment_schemes|max:255',
            ]);

            $initalFee = '';

            $paymentScheme = new paymentScheme;
            $paymentScheme->name = $request->name;
            $paymentScheme->fees = $initalFee;
            $paymentScheme->save();

            $request->session()->flash('success', 'You have successfully Created the Profile');

            return view('admin.paymentScheme.index',[
                'paymentSchemedata' => paymentScheme::where('name',$request->name)->first(),
                'paymentProfiles' => paymentScheme::all()
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\paymentScheme  $paymentScheme
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.paymentScheme.index',[
            'paymentSchemedata' => paymentScheme::where('id',$id)->first(),
            'paymentProfiles' => paymentScheme::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paymentScheme  $paymentScheme
     * @return \Illuminate\Http\Response
     */
    public function edit(paymentScheme $paymentScheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\paymentScheme  $paymentScheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paymentScheme $paymentScheme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paymentScheme  $paymentScheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        paymentScheme::destroy($id);
        $request->session()->flash('success', 'You have successfully Deleted the profile!');

        return view('admin.paymentScheme.index', [
            'paymentProfiles' => paymentScheme::all()
        ]);
    }

    public function addNewFee(Request $request)
    {
        $validated = $request->validate([
            'nameProfile' => 'required|max:255',
            'fullAmount' => 'required|max:7',
        ]);


        $profile = paymentScheme::find($request->profileId);

        $profile_fee = $profile->fees;

        if($profile_fee == ''){
            $profile_fee =
                array('fees' => 
                array(0 => 
                    array(
                        'feeName' => $request->nameProfile,
                        'fullAmount' => $request->fullAmount
                    )
            ));
        }else{
            $profile_fee['fees'][] = array(
                'feeName' => $request->nameProfile,
                'fullAmount' => $request->fullAmount
            );
        }
        
        
        //dd($profile_fee);

        $profile->fees = $profile_fee;
        $profile->save();

        $request->session()->flash('success', 'You have successfully Updated the Profile');

        return view('admin.paymentScheme.index',[
            'paymentSchemedata' => paymentScheme::where('id',$request->profileId)->first(),
            'paymentProfiles' => paymentScheme::all()
        ]);

    }

}
