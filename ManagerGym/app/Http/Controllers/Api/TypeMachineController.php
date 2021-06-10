<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\TypeMachine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TypeMachine::paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $typemachine = new TypeMachine();
        $typemachine->fill(request()->all());
        return $typemachine->save();
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data =  TypeMachine::with('devices')->where('id',$id)->first();
       return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TypeMachine $typemachine)
    {
        $typemachine->update(request()->only('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeMachine $typemachine)
    {
        DB::enableQueryLog();
        $devices = Device::where('type_machine_id',$typemachine->id)->get();
        $devices->each(function ($item){
            $item->update(['type_machine_id'=>null]);
        });
        $queries = DB::getQueryLog();
        return $typemachine->delete();
    }
    public function getAll()
    {
        return TypeMachine::all();
    }
}
