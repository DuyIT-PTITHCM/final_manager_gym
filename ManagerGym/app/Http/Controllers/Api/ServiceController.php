<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\DevicePartner;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    // thong ke cac dich vu theo thang
    public function statisticalService($id){
 
            $teamArr =[];
            $date = Carbon::now();
            $abc=  $date->toArray();
            $dt = Carbon::create($abc['year'], $abc['month'], 1, 0);
            $dateShow = $abc['day'] .'/'. $abc['month'].'/'. $abc['year'] ;
            $dtnext =  Carbon::create($abc['year']+1, 1, 1, 0);
            if($abc['month']<12){
                $dtnext =  Carbon::create($abc['year'], $abc['month']+1, 1, 0);
            }
            DB::enableQueryLog();
            $dps = DB::table('device_partners')->where('service_id',$id)
            ->whereBetween('created_at',[$dt,$dtnext])
            ->pluck('device_id');

             $sum = DB::table('device_partners')->where('service_id',$id)
            ->whereBetween('created_at',[$dt,$dtnext])->sum('price');
            $tamp = Service::find($id);

            foreach($dps as $item){
                $note = Device::find($item);
                array_push($teamArr,$note);
            }   
            $queries = DB::getQueryLog();
            return response()->json(['sum'=>$sum,'listDevice'=>$teamArr,'service'=>$tamp,'date'=> $dateShow],200);
    }
    //thong ke chi phi theo dich vu trong 1 nam 
    public function statisticalServiceYear($id){
 
        $teamArr =[];
        $date = Carbon::now();
        $abc=  $date->toArray();
        $dt = Carbon::create($abc['year'], 1, 1, 0);
        $dateShow = $abc['day'] .'/'. $abc['month'].'/'. $abc['year'] ;
         $tamp = Service::find($id);
        DB::enableQueryLog();
        $dps = DB::table('device_partners')->where('service_id',$id)
                ->where('created_at','>=',$dt)
                ->pluck('device_id');
        $sum =DB::table('device_partners')->where('service_id',$id)
                 ->where('created_at','>=',$dt)->sum('price');
        
        foreach($dps as $item){
            $note = Device::find($item);
            array_push($teamArr,$note);
        }   
        $queries = DB::getQueryLog();
        return response()->json(['sum'=>$sum,'listDevice'=>$teamArr ,'service'=>$tamp,'date'=> $dateShow],200);
}
    public function detailService(Request $request){
        $teamArr =[];
        $idDevice = $request->device_id;
        $idService = $request->service_id;
        $service = Service::find($idService);
        DB::enableQueryLog();
        $dps = DB::table('device_partners')->select('device_id','price','created_at','enddate')
            ->where('service_id',$idService)
            ->where('device_id',$idDevice)
            ->get();
        foreach($dps as $item){
            $note = Device::find($item->device_id);
            $note->price = $item->price;
            $note->enddate = $item->enddate;
            $note->date=Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('d-m-Y');
            array_push($teamArr,$note);
        }   
        $queries = DB::getQueryLog();
        $service->listDevice = $teamArr;
        return $service;
    }
}
