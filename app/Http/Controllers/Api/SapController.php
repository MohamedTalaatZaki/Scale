<?php

namespace App\Http\Controllers\Api;

use App\Models\Security\TransportDetail;
use App\Models\Views\SapApiRaw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SapController extends Controller
{
    public function getTransportsData(Request $request)
    {
        $transports = SapApiRaw::query()
            ->get();
        return response()->json($transports , 200 , [] , JSON_UNESCAPED_UNICODE);
    }

    public function setTransactionPostDate(Request $request)
    {
        $transportDetail = TransportDetail::query()
            //->whereNull('posted_at')
            ->find($request->input('SERIAL'));

        if($transportDetail) {
            $transportDetail->update(['posted_at' => Carbon::now()]);
            return response()->json(['status' => true]);
        }
        return response('Can Not Found Transport Number' , 404);
    }
}
