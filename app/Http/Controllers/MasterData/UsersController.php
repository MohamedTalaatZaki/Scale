<?php

namespace App\Http\Controllers\MasterData;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return view('master-data.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'full_name' =>  'required',
            'user_name' =>  'required|unique:users|min:4',
            'password'  =>  'required|confirmed|min:6',
            'email'     =>  'nullable|email|unique:users',
        ]);

        $data = collect($request->input());
        $data = $data->merge(['is_active'=>$request->input('is_active',0)]) ;
        $data = is_null($request->get('role_id')) ? $data->merge(['is_active'=>0]) : $data ;
        $user = User::query()
            ->create($data->merge(['password'=>Hash::make($request->input('password'))])->all());
        if($request->hasFile('avatar')) {
            $path   =   $request->file('avatar')->store("/users/avatars/{$user->id}"  , 'public');
            $user->update(['avatar' =>  $path]);
        }

        return redirect()->action('MasterData\UsersController@index')->with('success' , trans('global.user_created'));
    }

    public function edit($id)
    {
        $user   =   User::query()->findOrFail($id);
        return view('master-data.users.edit' , ['user'    =>  $user]);
    }

    public function update(Request $request , $id)
    {
        $this->validate($request , [
            'full_name' =>  'required',
            'user_name' =>  'required|min:4|unique:users,user_name,'.$id,
            'password'  =>  'nullable|confirmed|min:6',
            'email'     =>  'nullable|email|unique:users,email,'.$id,
        ]);
        $user = User::query()->findOrFail($id);
        $data = collect($request->input());
        $data = $data->merge(['is_active'=>$request->input('is_active',0)]) ;
        $data = is_null($request->get('password')) ? $data->except(['password','password_confirmation']) : $data->merge(['password'=>Hash::make($request->input('password'))]) ;
        $data = is_null($request->get('role_id')) ? $data->merge(['is_active'=>0]) : $data ;
        $user->update(
            $data->all()
        );
        if($request->hasFile('avatar')) {
            $path   =   $request->file('avatar')->store("/users/avatars/{$user->id}"  , 'public');
            $user->update(['avatar' =>  $path]);
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
        $user   =   Auth::user();

        $user->update([
            'theme' =>  $user->theme == "light" ? 'dark': 'light',
        ]);
        return "done";
    }
}
