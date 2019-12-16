<?php

namespace App\Http\Controllers;

use App\Filters\DashboardFilter;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use App\Models\Supplier\Supplier;
use App\Models\Views\TruckInfo;
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
    public function index(Request $request)
    {
        $request->offsetSet('filter_item_type' , $request->input('filter_item_type' , 'raw'));

        $dashboardData  =   TruckInfo::query()
            ->filter(new DashboardFilter($request))
            ->get();

        /*
         * Counters In Tons
         */

        $arrivedCounters    =   $dashboardData->filter(function($truck){
            return $truck->tractor_status == TransportDetail::ARRIVED || $truck->trailer_status == TransportDetail::ARRIVED ? true : false;
        });

        $waitingCounters    =   $dashboardData->where('status' , TransportDetail::WAITING);

        $sampledCounters    =   $dashboardData->filter(function($truck){
            return $truck->tractor_status == TransportDetail::SAMPLED || $truck->trailer_status == TransportDetail::SAMPLED? true : false;
        });

        $acceptedCounters   =   $dashboardData->filter(function($truck){
            return $truck->tractor_status == TransportDetail::ACCEPTED || $truck->trailer_status == TransportDetail::ACCEPTED ? true : false;
        });

        $rejectedCounters   =   $dashboardData->filter(function($truck){
            return $truck->tractor_status == TransportDetail::REJECTED || $truck->trailer_status == TransportDetail::REJECTED ? true : false;
        });

        $inProcessCounters  =   $dashboardData->where('status' , TransportDetail::IN_PROCESS);

        $departureCounters  =   $dashboardData->where('status' , TransportDetail::DEPARTURE);

        $canceledCounters   =   $dashboardData->where('status' , TransportDetail::CANCELED);

        /*
         * End Counters In Tons
         */


        return view('dashboard.index' , [
            'dashboardData'=>$dashboardData,
            'arrivedCounters'=>$arrivedCounters,
            'waitingCounters'=>$waitingCounters,
            'sampledCounters'=>$sampledCounters,
            'acceptedCounters'=>$acceptedCounters,
            'rejectedCounters'=>$rejectedCounters,
            'inProcessCounters'=>$inProcessCounters,
            'departureCounters'=>$departureCounters,
            'canceledCounters'=>$canceledCounters,
            'item_types'=>ItemType::all(),
            'item_groups'=>ItemGroup::query()->ItemGroupsByPrefix($request->input('filter_item_type'))->get(),
            'suppliers'=>Supplier::query()->SupplierByItemTypePrefix($request->input('filter_item_type'))->get()
        ]);
    }

    public function getSuppliersAndItemGroupByItemTypePrefix(Request $request)
    {
        return response()->json([
            'item_groups'=>ItemGroup::query()->ItemGroupsByPrefix($request->input('filter_item_type'))->get(),
            'suppliers'=>Supplier::query()->SupplierByItemTypePrefix($request->input('filter_item_type'))->get()
        ]);
    }
}
