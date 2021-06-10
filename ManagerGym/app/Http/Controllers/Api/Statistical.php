<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Statistical extends Controller
{
    //thong ke cac thiet bi mua trong thang
    public function statisticalNowBuy(){
        $date = Carbon::now();
        $abc=  $date->toArray();
        $dt = Carbon::create($abc['year'], $abc['month'], 1, 0);
        $dtnext =  Carbon::create($abc['year']+1, 1, 1, 0);
        if($abc['month']<12){
            $dtnext =  Carbon::create($abc['year'], $abc['month']+1, 1, 0);
        }
        return Device::with('supplier')->without('status')->whereBetween('created_at',[$dt,$dtnext])->get();
        
    }
    //thong ke cac thiet bi mua trong nam
    public function statisticalNowYearBuy(){
        $date = Carbon::now();
        $abc=  $date->toArray();
        $dt = Carbon::create($abc['year'],1, 1, 0);
        return Device::with('supplier')->without('status')->where('created_at','>=',$dt)->get();
        
    }

      //thong ke cac thiet bi mua trong thang
      public function statisticalNowSales(){
        $date = Carbon::now();
        $abc=  $date->toArray();
        $dt = Carbon::create($abc['year'], $abc['month'], 1, 0);
        $dtnext =  Carbon::create($abc['year']+1, 1, 1, 0);
        if($abc['month']<12){
            $dtnext =  Carbon::create($abc['year'], $abc['month']+1, 1, 0);
        }
        return Device::with('purchasing')->without('status')->where('purchasing_id','<>',null)
                        ->where('pricesales','<>',null)
                        ->whereBetween('created_at',[$dt,$dtnext])
                        ->get();
        
    }

    //thong ke cac thiet bi da ban trong nam
    public function statisticalNowYearSales(){
        $date = Carbon::now();
        $abc=  $date->toArray();
        $dt = Carbon::create($abc['year'],1, 1, 0);
        return Device::with('purchasing')->without('status')
            ->where('purchasing_id','<>',null)
            ->where('pricesales','<>',null)
            ->where('created_at','>=',$dt)
            ->get();
        
    }

}
