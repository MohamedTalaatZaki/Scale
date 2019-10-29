<?php

namespace App\Http\Controllers\Security;

use App\Models\Security\Transports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function index()
    {
        $raw    =   Transports::query()
            ->where('status' , 'accepted')
            ->whereHas('itemType' , function ($q){$q->where('prefix' , 'raw');})
            ->get();

        $scrap    =   Transports::query()
            ->where('status' , 'accepted')
            ->whereHas('itemType' , function ($q){$q->where('prefix' , 'scrap');})
            ->get();

        $finish    =   Transports::query()
            ->where('status' , 'accepted')
            ->whereHas('itemType' , function ($q){$q->where('prefix' , 'finish');})
            ->get();

        return view('security.queue.index' , [
            'raw'       =>  $raw,
            'scrap'     =>  $scrap,
            'finish'    =>  $finish,
        ]);
    }
}
