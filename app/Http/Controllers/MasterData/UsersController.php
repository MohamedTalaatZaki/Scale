<?php

namespace App\Http\Controllers\MasterData;

use App\Filters\UsersIndexFilter;
use App\Models\Roles\Role;
use App\Traits\AuthorizeTrait;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('users.index');
        $roles = Role::all();
        $users = User::query()
            ->filter(new UsersIndexFilter(request()))
            ->paginate(25);
        return view('master-data.users.index', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $this->authorized('users.create');
        $roles = Role::all();
        return view('master-data.users.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->authorized('users.create');
        $this->validate($request, [
            'full_name' => 'required',
            'user_name' => 'required|unique:users|min:4',
            'password' => 'required|confirmed|min:6',
            'email' => 'nullable|email|unique:users',
            'role_id' => 'nullable|exists:roles,id',
            'lang' => 'in:ar,en',
            'theme' => 'in:light,dark',
        ],[
            'full_name.required'=>trans('master.errors.full_name_required'),
            'user_name.required'=>trans('master.errors.user_name_required'),
            'user_name.unique'=>trans('master.errors.user_name_unique'),
            'user_name.min'=>trans('master.errors.user_name_min'),
            'password.required'=>trans('master.errors.password_required'),
            'password.confirmed'=>trans('master.errors.password_confirmed'),
            'password.min'=>trans('master.errors.password_min'),
        ]);
        $user = User::query()->create($request->input());

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store("/users/avatars/{$user->id}", 'public');
            $user->update(['avatar' => $path]);
        }

        if ($request->get('role_id') != null) {
            $user->attachRole($request->get('role_id'));
            $user->update(['is_active' => $request->input('is_active', 0)]);
        } else {
            $user->update(['is_active' => false]);
        }

        return redirect()
            ->action('MasterData\UsersController@index')
            ->with('success', is_null($request->get('role_id')) ? trans("global.user_created_without_role") : trans("global.user_created"));
    }

    public function edit($id)
    {
        $this->authorized('users.edit');
        $user = User::query()->findOrFail($id);
        $roles = Role::all();
        return view('master-data.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $this->authorized('users.edit');
        $this->validate($request, [
            'full_name' => 'required',
            'user_name' => 'required|min:4|unique:users,user_name,' . $id,
            'password' => 'nullable|confirmed|min:6',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'role_id' => 'nullable|exists:roles,id',
            'lang' => 'in:ar,en',
            'theme' => 'in:light,dark',
        ]);

        $user = User::query()->findOrFail($id);
        $user->update(
            is_null($request->get('password')) ? $request->except('password') : $request->input()
        );

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store("/users/avatars/{$user->id}", 'public');
            $user->update(['avatar' => $path]);
        }

        if ($request->get('role_id') != null) {
            $user->roles()->sync([]);
            $user->attachRole($request->get('role_id'));
            $user->update(['is_active' => $request->input('is_active', 0)]);
        } else {
            $user->roles()->sync([]);
            $user->update(['is_active' => !!$user->is_admin]);
        }
        return redirect()->action('MasterData\UsersController@index')
            ->with('success', is_null($request->get('role_id')) ? trans("global.user_updated_without_role") : trans("global.user_updated"));
    }

    public function show($id)
    {

    }

    public function destroy($id)
    {

    }


    public function theme()
    {
        $user = Auth::user();

        $user->update([
            'theme' => $user->theme == "light" ? 'dark' : 'light',
        ]);
        return "done";
    }

    public function changeAccInfo(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'password' => 'nullable|confirmed|min:6',
            'lang' => 'in:ar,en',
            'theme' => 'in:light,dark',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('openAccountInfo', '')->withErrors($validate->errors());
        }

        $user = Auth::user();
        $user->update([
            'lang' => $request->get('lang'),
            'theme' => $request->get('theme'),
        ]);

        if (!is_null($request->get('password'))) {
            $user->update(['password' => $request->get('password')]);
        }

        return redirect()->back()->with('notify', trans('global.change_acc_info_success'));
    }
}
