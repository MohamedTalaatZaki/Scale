<?php

namespace App\Http\Controllers\MasterData;

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
        return view('master-data.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'full_name' =>  'required',
            'user_name' =>  'required',
            'password'  =>  'required|confirmed',
            ''
        ]);
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
