<?php

namespace App\Http\Controllers\QC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrivedTrucksController extends Controller
{
    public function index()
    {
        return view('quality-control.arrived-trucks.index');
    }
}
