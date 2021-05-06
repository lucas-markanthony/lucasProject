<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\paymentScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


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
            /*$initalFee =
                array('fees' => 
                array(0 => 
                    array(
                        'feeName' => 'Tuition',
                        'fullAmount' => '0'
                    )
            ));

            $initalFee['fees'][] = array(
                'feeName' => 'Miscellaneous',
                'fullAmount' => '0'
            );*/

            //$paymentScheme = paymentScheme::create(array('name' => $request->name, 'fees' => $initalFee));

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
            'name' => 'required|max:255',
            'fullAmount' => 'required|max:7',
        ]);


        $profile = paymentScheme::find($request->profileId);

        $profile_fee = $profile->fees;

        if($profile_fee == ''){
            $profile_fee =
                array('fees' => 
                array(0 => 
                    array(
                        'feeName' => $request->name,
                        'fullAmount' => $request->fullAmount
                    )
            ));
        }else{
            $profile_fee['fees'][] = array(
                'feeName' => $request->name,
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
