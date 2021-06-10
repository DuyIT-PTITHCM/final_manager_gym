<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DevicePartner;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PartnerDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DevicePartner::where('device_id',2)->max('enddate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dateNow = Carbon::now();
        $dtdb =DevicePartner::where('device_id',$request->device_id)->max('enddate');
        if($dateNow->greaterThan($dtdb)){
            $devicepartner= new DevicePartner;
            $devicepartner->fill(request()->all());
            $devicepartner->save();
            return true;
        }
        return response()->json(['messeage'=>'Data nhu lol'],402);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DevicePartner $devicepartner)
    {
        return $devicepartner;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DevicePartner $devicepartner)
    {
        return $devicepartner->update(request()->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DevicePartner $devicepartner)
    {
        return $devicepartner->delete();
    }
}
