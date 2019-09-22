<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Scales\Scale;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScalesController extends Controller
{
    use AuthorizeTrait;

    public function index() {
        $this->authorized('scales.index');
        return view('master-data.scales.index' , [
            'scales'    =>  Scale::query()->paginate(25),
        ]);
    }

    public function create() {

    }
}
