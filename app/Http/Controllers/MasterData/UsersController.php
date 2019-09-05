<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Roles\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('master-data.users.index' , [
            'users' =>  User::query()->paginate(15),
        ]);
    }

    public function create()
    {
        $roles  =   Role::all();
        return view('master-data.users.create' , ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'full_name' =>  'required',
            'user_name' =>  'required|unique:users',
            'password'  =>  'required|confirmed|min:6',
            'email'     =>  'nullable|unique:users',
            'role_id'   =>  'nullable|exists:roles,id'
        ]);

        $user = User::query()->create($request->input());

        if($request->hasFile('avatar')) {
            $path   =   $request->file('avatar')->store("/users/avatars/{$user->id}"  , 'public');
            $user->update(['avatar' =>  $path]);
        }

        if($request->get('role_id') != null) {
            $user->attachRole($request->get('role_id'));
        } else {
            $user->update(['is_active' => false]);
        }

        return redirect()->action('MasterData\UsersController@index')->with('success' , trans('global.user_created'));
    }

    public function edit($id)
    {
        $user   =   User::query()->findOrFail($id);
        $roles  =   Role::all();
        return view('master-data.users.edit' , ['user'  =>  $user , 'roles' => $roles]);
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'full_name' =>  'required',
            'user_name' =>  'required|unique:users,id',
            'password'  =>  'nullable|confirmed|min:6',
            'email'     =>  'nullable|unique:users,id',
            'role_id'   =>  'nullable|exists:roles,id'
        ]);

        $user = User::query()->findOrFail($id);
        $user->update(
            is_null($request->get('password')) ? $request->except('password') : $request->input()
        );

        if($request->hasFile('avatar')) {
            $path   =   $request->file('avatar')->store("/users/avatars/{$user->id}"  , 'public');
            $user->update(['avatar' =>  $path]);
        }

        if($request->get('role_id') != null) {
            $user->roles()->sync([]);
            $user->attachRole($request->get('role_id'));
        } else {
            $user->roles()->sync([]);
            $user->update(['is_active' => false]);
        }

        return redirect()->action('MasterData\UsersController@index')->with('success' , trans('global.user_updated'));
    }

    public function show($id) {

    }

    public function destroy($id)
    {

    }


    public function theme()
    {
        $user   =   \Auth::user();

        $user->update([
            'theme' =>  $user->theme == "light" ? 'dark': 'light',
        ]);
        return "done";
    }
}
