<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Gate;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoggingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('logged-in')){
            return redirect(route('login'));
        }
        
        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW USER MANAGEMENT MENU', '');
        
        return view('admin.users.index', [
            'users' => User::paginate(10),
            'roles' => Role::all()
        ]);


        dd('access not allowed');
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if(!Gate::allows('is-admin')){
            $request->session()->flash('error', 'Action not allowed');
            return redirect(route('admin.users.index'));
        }

        $validatedData = $request->validated();
        $newuser = new CreateNewUser();
        $user = $newuser->create($request->all());
        $user->roles()->sync($request->roles);
        Password::sendResetLink($request->only(['email']));

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'REGISTER WEB USER', 'You have successfully Created the user! password reset link sent to ' . $request->email);


        $request->session()->flash('success', 'You have successfully Created the user! password reset link sent to ' . $request->email);
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auditTrails = DB::table('loggings')
            ->where('user', $id)
            ->orderBy('created_at', 'desc')->paginate(10);

            
        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'VIEW WEB USER', $id);

        return view('admin.users.user', [
            'roles' => Role::all(),
            'user' => User::find($id),
            'auditTrails' => $auditTrails 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user){
            $request->session()->flash('error', 'You cannot update this User!');
            return redirect(route('admin.users.index'));
        }

        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'UPDATE WEB USER', 'You have successfully Updated the user!' . $id);

        $request->session()->flash('success', 'You have successfully Updated the user!');

        return redirect(route('admin.users.show', $user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);

        $logger = new LoggingController;
        $logger->storeHistory(Auth::user()->id, 'DELETE WEB USER', 'You have successfully Deleted the user!' . $id);

        $request->session()->flash('success', 'You have successfully Deleted the user!');

        return redirect(route('admin.users.index'));
    }
}
