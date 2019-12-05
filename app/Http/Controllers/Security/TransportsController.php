<?php

namespace App\Http\Controllers\Security;

use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\MasterData\TruckType;
use App\Models\Security\BlockedDriver;
use App\Models\Security\BlockedReason;
use App\Models\Security\Transports;
use App\Models\Supplier\Supplier;
use App\Rules\RequiredIfItemTypeRaw;
use App\Traits\AuthorizeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportsController extends Controller
{
    use AuthorizeTrait;
    public function index()
    {
        $this->authorized('transports.index');

        $suppliers  =   Supplier::query()
            ->where('is_active' , 1)
            ->get();
        $governorates   =   Governorate::query()
            ->where('is_active' , 1)
            ->get();

        $truck_types    =   TruckType::query()
            ->get();

        $item_types     =   ItemType::query()
            ->get();

        $arrivalTrucks  =   Transports::query()
            ->where(function ($q){
                $q->where('status' , 'arrived')->orWhere('status' , 'sampled');
            })
            ->whereHas('itemType' , function ($q){$q->where('prefix' , 'raw');})
            ->paginate(15);

        $rawTrucks  =   Transports::query()
            ->rawOrder()
            ->paginate(15);

        $scrapTrucks  =   Transports::query()
            ->scrapOrder()
            ->paginate(15);

        $finishTrucks  =   Transports::query()
            ->finishOrder()
            ->paginate(15);

        $inProcessTrucks    =   Transports::query()
            ->where('status' , 'in_process')
            ->paginate(15);

        $departures    =   Transports::query()
            ->where('status' , 'departure')
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->paginate(15);

        $canceled   =   Transports::query()
            ->where('status' , 'canceled')
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->paginate(15);

        $rejected   =   Transports::query()
            ->where('status' , 'rejected')
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->paginate(15);

        $cancelReason   =   BlockedReason::all();

        return view('security.transports.index' , [
            'suppliers'     =>  $suppliers,
            'governorates'  =>  $governorates,
            'truck_types'   =>  $truck_types,
            'item_types'    =>  $item_types,
            'arrivalTrucks' =>  $arrivalTrucks,
            'rawTrucks'     =>  $rawTrucks,
            'scrapTrucks'   =>  $scrapTrucks,
            'finishTrucks'  =>  $finishTrucks,
            'inProcessTrucks'  =>  $inProcessTrucks,
            'departures'    =>  $departures,
            'canceled'      =>  $canceled,
            'rejected'      =>  $rejected,
            'reasons'       =>  $cancelReason,
        ]);
    }


    public function store(Request $request)
    {
        $this->authorized('transports.create');
        $this->validate($request , [
            'driver_name'  =>  'required',
            'driver_license'  =>  'required',
            'driver_national_id'  =>  'required|digits:14|numeric',
            'driver_mobile'  =>  'required|digits:11|numeric',
            'supplier_id'  =>  'required|exists:suppliers,id',
            'governorate_id'  =>  'required|exists:governorates,id',
            'city_id'  =>  'required|exists:cities,id',
            'center_id' =>  'nullable|numeric',
            'truck_type_id'  =>  'required|exists:trucks_types,id',
            'truck_plates_tractor'  =>  'required',
            'item_type_id'  =>  'required|exists:item_types,id',
            'item_group_id'  =>  [new RequiredIfItemTypeRaw()],
            'theoretical_weight'  =>  [new RequiredIfItemTypeRaw()],
        ]);

        $request->offsetSet('arrival_time' , Carbon::now());
        $request->offsetSet('transport_number' , Carbon::now()->timestamp);
        $request->offsetSet('status' , isItemTypeRaw($request->input('item_type_id')) ? 'arrived' : 'waiting');
        $request->offsetSet('order' , nextRowOrder());

        $transport    =   Transports::query()->create($request->input());

        $transport->details()->create(['truck_plates' => $transport->truck_plates_tractor , 'status' => $transport->status ]);

        BlockedDriver::query()->updateOrCreate([
            'license'       => $request->get('driver_license')
        ],[
            'license'       =>  $request->get('driver_license'),
            'name'          =>  $request->get('driver_name'),
            'national_id'   =>  $request->get('driver_national_id'),
            'mobile'        =>  $request->get('driver_mobile'),
        ]);

        if(!is_null($transport->truck_plates_trailer)) {
            $transport->details()->create(['truck_plates' => $transport->truck_plates_trailer , 'status' => $transport->status , 'is_trailer' => 1]);
        }
        \Session::flash('print' , $transport->id);
        return redirect()->action('Security\TransportsController@index')->with('success' , trans('global.created_success'));
    }

    public function edit($id)
    {
        $this->authorized('transports.edit');
        $truckArrival   =   Transports::query()->find($id);
        return $this->index()->with(['truckArrival'  =>  $truckArrival]);
    }

    public function update(Request $request , $id)
    {
        $this->authorized('transports.edit');
        $this->validate($request , [
            'driver_name'  =>  'required',
            'driver_license'  =>  'required',
            'driver_national_id'  =>  'required|digits:14|numeric',
            'driver_mobile'  =>  'required|digits:11|numeric',
            'supplier_id'  =>  'required|exists:suppliers,id',
            'governorate_id'  =>  'required|exists:governorates,id',
            'city_id'  =>  'required||exists:cities,id|exists:cities,id',
            'center_id' =>  'nullable||exists:centers,id|numeric',
            'truck_type_id'  =>  'required|exists:trucks_types,id',
            'truck_plates_tractor'  =>  'required',
            'item_type_id'  =>  'required|exists:item_types,id',
            'item_group_id'  =>  [new RequiredIfItemTypeRaw()],
            'theoretical_weight'  =>  [new RequiredIfItemTypeRaw()],
        ]);


        $request->offsetSet('status' , isItemTypeRaw($request->input('item_type_id')) ? 'arrived' : 'waiting');
        $transport  =   Transports::query()->find($id);

        $transport->update($request->input());

        $transport->details()->delete();
        $transport->details()->create(['truck_plates' => $transport->truck_plates_tractor , 'status' => $transport->status]);

        if(!is_null($transport->truck_plates_trailer)) {
            $transport->details()->create(['truck_plates' => $transport->truck_plates_trailer , 'status' => $transport->status , 'is_trailer' => 1]);
        }

        return redirect()->action('Security\TransportsController@index')->with('success' , trans('global.updated_success'));
    }

    public function inProcess(Request $request)
    {
        $transport  =   Transports::query()->find($request->get('id'));
        $transport->update(['status' => 'in_process']);
//        $transport->details()->update(['status' => 'in_process']);
        return redirect()->action('Security\TransportsController@index')->with('success' , trans('global.car_in_process' , ['truck_plates_tractor' => $transport->truck_plates_tractor]));
    }

    public function checkOut(Request $request)
    {
        $transport  =   Transports::query()->find($request->get('id'));
        $transport->update(['status' => 'departure']);
        if($request->has('block_driver'))
        {
            $this->blockDriver($transport , $request);
        }
        return redirect()->action('Security\TransportsController@index')->with('success' , trans('global.car_departure' , ['truck_plates_tractor' => $transport->truck_plates_tractor]));
    }

    public function cancel(Request $request) {
        $transport  =   Transports::query()->find($request->get('transport_id'));
        $transport->update(['status' => 'canceled']);
        if($request->has('block_driver'))
        {
            $this->blockDriver($transport , $request);
        }
        return redirect()->action('Security\TransportsController@index')->with('success' , trans('global.car_canceled' , ['truck_plates_tractor' => $transport->truck_plates_tractor]));
    }

    public function print(Request $request)
    {
        app()->setLocale('ar');
        $transport  =   Transports::query()->find($request->get('id'));
        return view('security.transports.partial.print' , ['transport' => $transport]);
    }

    private function blockDriver(Transports $transport , Request $request)
    {
        $driver     =   BlockedDriver::query()->where('national_id' , $transport->driver_national_id)->first();
        $driver->update([
            'is_blocked' => 1,
            'blocked_count' =>  $driver->blocked_count + 1,
            'blocked_by'    =>  \Auth::id(),
            'blocked_reason_id' =>  $request->input('reason_id'),
            'block_reason'  =>  $request->input('note')
        ]);
        $driver->logs()->create([
            'blocked_by'    =>  \Auth::id(),
            'blocked_reason_id' =>  $request->input('reason_id'),
            'block_reason'  =>  $request->input('note')
        ]);
    }
}

