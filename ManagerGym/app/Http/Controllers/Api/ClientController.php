<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Device;

class ClientController extends Controller
{
    public function getUserLogin(){
    	return Auth::user();
    }
    public function getDataDevice(){
    	 $department_id = Auth::user()->department_id;
    	 if(!is_null($department_id)){
    	 	return Department::with('devices')->where('id',$department_id)->first();
    	 }
    	 else{
    	 	return  Auth::user();
    	 }
    }
    public function update(Request $request,  $id)
    {
    	$device = Device::find($id);
    	$device->status_id = $request->status_id;
        return $device->update();
    }

}
