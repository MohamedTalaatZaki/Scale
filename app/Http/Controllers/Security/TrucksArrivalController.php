<?php

namespace App\Http\Controllers\Security;

use App\Models\Governorate;
use App\Models\Items\ItemGroup;
use App\Models\Items\ItemType;
use App\Models\MasterData\TruckType;
use App\Models\Security\TruckArrival;
use App\Models\Supplier\Supplier;
use App\Rules\RequiredIfItemTypeRaw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrucksArrivalController extends Controller
{
    public function index()
    {
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

        $items_groups   =   ItemGroup::query()
            ->get();

        return view('security.truck-arrival.index' , [
            'suppliers'     =>  $suppliers,
            'governorates'  =>  $governorates,
            'truck_types'   =>  $truck_types,
            'item_types'    =>  $item_types,
            'items_groups'  =>  $items_groups
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'driver_name'  =>  'required',
            'driver_license'  =>  'required',
            'driver_national_id'  =>  'required|digits:14|numeric',
            'driver_mobile'  =>  'required|digits:11|numeric',
            'supplier_id'  =>  'required|exists:suppliers,id',
            'governorate_id'  =>  'required|exists:governorates,id',
            'city_id'  =>  'required|exists:cities,id',
            'center_id' =>  'numeric',
            'truck_type_id'  =>  'required|exists:trucks_types,id',
            'truck_plates_tractor'  =>  'required',
            'item_type_id'  =>  'required|exists:item_types,id',
            'item_group_id'  =>  [new RequiredIfItemTypeRaw()],
            'theoretical_weight'  =>  [new RequiredIfItemTypeRaw()],
        ]);

        $request->offsetSet('arrival_time' , Carbon::now());
        $request->offsetSet('transport_number' , Carbon::now()->timestamp);
        $request->offsetSet('status' , new RequiredIfItemTypeRaw() ? 'arrived' : 'waiting');

        $arrival    =   TruckArrival::query()->create($request->input());

        return redirect()->action('Security\TrucksArrivalController@index')->with('success' , trans('global.created_success'));
    }
}
