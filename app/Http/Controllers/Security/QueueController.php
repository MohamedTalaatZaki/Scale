<?php

namespace App\Http\Controllers\Security;

use App\Models\Security\Transports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    public function index()
    {
        app()->setLocale('ar');
        $raw    =   Transports::query()->rawOrder()->get();

        $scrap    =   Transports::query()->scrapOrder()->get();

        $finish    =   Transports::query()->finishOrder()->get();

        return view('security.queue.index' , [
            'raw'       =>  $raw,
            'scrap'     =>  $scrap,
            'finish'    =>  $finish,
            'page_dir'  =>  'rtl'
        ]);
    }
}
