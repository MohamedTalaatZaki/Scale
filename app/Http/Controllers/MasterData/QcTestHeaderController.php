<?php

namespace App\Http\Controllers\MasterData;

use App\Models\QC\QcTestHeader;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QcTestHeaderController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('qc-test-headers.index');
        return  view('master-data.qc-test-header.index' , [
            'qc_test_headers'  =>   QcTestHeader::query()->paginate('25'),
        ]);
    }

    public function create()
    {
        $this->authorized('qc-test-headers.create');
    }
}
