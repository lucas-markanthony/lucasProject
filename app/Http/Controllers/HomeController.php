<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('home');
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
        $sectionsdata = DB::table('gradeSection')
        ->where('grade', '=', $id)
        ->select('section')->get();
        return json_encode($sectionsdata);
    }
}
