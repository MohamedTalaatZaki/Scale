<?php

namespace App\Http\Controllers\Security;

use App\Models\Security\BlockedDriver;
use App\Traits\AuthorizeTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlockedDriversController extends Controller
{
    use AuthorizeTrait;

    public function index()
    {
        $this->authorized('blocked-drivers.index');
        $drivers    =   BlockedDriver::query()->where('is_blocked' , 1)->paginate(25);
        return view('security.blocked-drivers.index' , ['drivers' => $drivers]);
    }

    public function checkIfBlocked(Request $request)
    {
        $driver =   BlockedDriver::query()
            ->where( 'national_id' , $request->input('national_id'))
            ->where('is_blocked' , 1)
            ->first();

        return  $driver ? $driver : null;

    }

    public function update(Request $request , $id)
    {
        $this->authorized('blocked-drivers.edit');
        $driver =   BlockedDriver::query()->find($id);

        if ($driver)
        {
            $driver->update([
                'is_blocked'        =>  0,
                'blocked_by'        =>  null,
                'blocked_reason_id' =>  null,
                'block_reason'      =>  null,
            ]);
        }

        return redirect()->action('Security\BlockedDriversController@index')->with('success' , trans('global.driver_unblocked_success'));
    }
}
