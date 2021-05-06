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

        if(Gate::allows('is-admin')){
            return view('admin.users.index', [
                'users' => User::paginate(10),
                'roles' => Role::all()
            ]);
        }

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
        $validatedData = $request->validated();

        $newuser = new CreateNewUser();
        $user = $newuser->create($request->all());

        $user->roles()->sync($request->roles);

        Password::sendResetLink($request->only(['email']));
        
        $request->session()->flash('success', 'You have successfully Created the user!');

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
        return view('admin.users.user', [
            'roles' => Role::all(),
            'user' => User::find($id)
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
        $request->session()->flash('success', 'You have successfully Deleted the user!');

        return redirect(route('admin.users.index'));
    }
}
