<?php

namespace App\Http\Controllers;

use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use AuthorizeTrait;
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
       // $this->authorized('home');
        return view('dashboard.index');
    }
}
