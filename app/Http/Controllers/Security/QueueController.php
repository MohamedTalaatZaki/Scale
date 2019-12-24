<?php

namespace App\Http\Controllers\Security;

use App\Models\Security\Transports;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QueueController extends Controller
{
    use AuthorizeTrait;
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

    public function editQueueIndex(){
        $this->authorized('edit-queue.index');
        $raw    =   Transports::query()->rawOrder()->get();

        $scrap    =   Transports::query()->scrapOrder()->get();

        $finish    =   Transports::query()->finishOrder()->get();

        return view('security.queue.create' , [
            'raw'       =>  $raw,
            'scrap'     =>  $scrap,
            'finish'    =>  $finish,
        ]);

    }

    public function reorderQueue(Request $request) {
        $queue  =   null;
        if($request->input('type') == 'raw') {
            $queue    =   Transports::query()->rawOrder()->pluck('order' , 'id');
        } elseif ($request->input('type') == 'scrap') {
            $queue    =   Transports::query()->scrapOrder()->pluck('order' , 'id');

        } elseif ($request->input('type') == 'finish') {
            $queue    =   Transports::query()->finishOrder()->pluck('order' , 'id');
        } else {
            return response()->json(['error' => 'can not Found Queue']);
        }
        $newOrder   =   array_combine($request->input('ids') , $queue->toArray());
        foreach ($newOrder as $id => $order)
        {
            $transport  =   Transports::query()->find($id);
            if ($transport) {
                $transport->update(['order' =>  $order]);
            }
        }
        return response()->json(['success' => 'Done']);
    }
}
