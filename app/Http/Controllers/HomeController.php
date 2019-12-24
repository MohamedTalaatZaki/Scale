<?php

namespace App\Http\Controllers;

use App\Filters\DashboardFilter;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\Production\TransportLine;
use App\Models\QC\QcElement;
use App\Models\QC\SampleTestHeader;
use App\Models\Security\TransportDetail;
use App\Models\Security\Transports;
use App\Models\Supplier\Supplier;
use App\Models\Views\AcceptedResultDetail;
use App\Models\Views\TruckInfo;
use App\Traits\AuthorizeTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        $request->offsetSet('filter_from_date' , $request->input('filter_from_date' , Carbon::now()->subDay()->format('Y-m-d h:m')));
        $request->offsetSet('filter_to_date' , $request->input('filter_to_date' , Carbon::now()->format('Y-m-d h:m')));

        $dashboardData  =   TruckInfo::query()
            ->filter(new DashboardFilter($request))
            ->with('trucksLineTransactions')
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

        $transportLines =   $this->getTransportLines($dashboardData);

        $topSuppliers   =   $this->topSuppliers($dashboardData);

        $linesWeight    =   $this->getLinesWeight($transportLines);

        $qcResults      =   $this->getQcElementByBatchNumber($request);

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
            'transportLines'=>$transportLines->paginate(10),
            'transportLinesWeight'=>$transportLines->sum('weight'),
            'item_types'=>ItemType::all(),
            'item_groups'=>ItemGroup::query()->ItemGroupsByPrefix($request->input('filter_item_type'))->get(),
            'topSuppliers'=>json_encode($topSuppliers),
            'linesWeight'=>json_encode($linesWeight),
            'qcResultsLabels'=>json_encode($qcResults->pluck('truck_plates')),
            'qcResultsData'=>json_encode($qcResults->pluck('sampled_range')),
            'qcElements'=>QcElement::query()->where('element_type' , 'range')->get(),
            'suppliers'=>Supplier::query()
                ->SupplierByItemTypePrefix($request->input('filter_item_type'))
                ->FilterByItemGroup($request->input('filter_item_group') , 0)
                ->get()
        ]);
    }

    public function getSuppliersAndItemGroupByItemTypePrefix(Request $request)
    {
        return response()->json([
            'item_groups'=>ItemGroup::query()->ItemGroupsByPrefix($request->input('filter_item_type'))->get(),
            'suppliers'=>Supplier::query()
                ->SupplierByItemTypePrefix($request->input('filter_item_type'))
                ->FilterByItemGroup($request->get('filter_item_group') , 0)
                ->get()
        ]);
    }

    private function getTransportLines($dashboardData){
        $TableCollection =   new Collection();
        $rawTableData       =   $dashboardData
            ->where('status' , TransportDetail::DEPARTURE)
            ->each(function($truck) use(&$TableCollection){
            $truck->trucksLineTransactions->each(function($lineTransaction)use($TableCollection){
                $TableCollection->push($lineTransaction);
            });
        });

        return $TableCollection;
    }

    private function topSuppliers($dashboardData)
    {
        $suppliers = $dashboardData
            ->where('status' , TransportDetail::DEPARTURE)
            ->groupBy('supplier_id')
            ->mapWithKeys( function($supplierTrucks){
                $supplier   =   $supplierTrucks->first()->supplier->name;
                return[
                    $supplier =>
                        array_sum(
                            $supplierTrucks->map(function($truck){
                                return $truck->trucksLineTransactions->sum('weight');
                            })->toArray())
                ];
            })->toArray();
        arsort($suppliers);
        if(count($suppliers) > 3)
        {
            $topThree   =   array_slice($suppliers , 0 , 3);
            $others     =   ['others' => array_sum(array_slice($suppliers , 3 ))];
            $suppliers  =   array_merge($topThree , $others);
        }
        return $suppliers;
    }

    private function getLinesWeight($transportLines)
    {
        $lines = $transportLines->groupBy('line_id')->mapWithKeys(function($line){
            if(isset($line->first()->line)){
                return [ $line->first()->line->name => $line->sum('weight') ];                
            } else {
                return [];
            };
        });
        return $lines;
    }

    public function getQcElementByBatchNumber(Request $request)
    {
        if($request->has('filter_batch_number') && $request->has('filter_qc_element'))
        {
            $qcResults  =   AcceptedResultDetail::query()
                ->filter(new DashboardFilter($request))
                ->where('batch_number' , $request->input('filter_batch_number'))
                ->where('element_name' , $request->input('filter_qc_element'))
                ->orderBy('created_at')
                ->get();

            return $qcResults;
        } else {
            return collect([]);
        }
    }
}
