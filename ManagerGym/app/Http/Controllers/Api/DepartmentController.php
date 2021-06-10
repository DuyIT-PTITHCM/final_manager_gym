<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::with('user')->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        if(is_null($request->user_id)){
             $department =Department::create(request()->all());
             return true;
        }
        else if(is_null($user->department_id)){
            $department =Department::create(request()->all());
            $user->department_id= $department->id;
            $user->save();
            return true;
        }else{
            return response()->json(['message'=>"user has department"],402);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Department::with('user','devices')->where('id',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
       if(!is_null($request->user_id) && $request->user_id != $department->user_id){ 
            // user tro lai thang department nay
            User::where('id',$request->user_id)
                 ->update(['department_id'=>$department->id]);
           //xu ly cho thang hien tai cua no tro den phong null
            User::where('id',$department->user_id)
                ->update(['department_id'=>null]);
        }
        return $department->update(request()->only(['user_id','name']));
   
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        // lay casi phong ma no dang lam viec tro den null 
        User::where('id',$department->user_id)->update([
            'department_id'=>null
        ]);
        DB::enableQueryLog();
        $devices = Device::where('department_id',$department->id)->get();
        $devices->each(function ($item){
            $item->update(['department_id'=>null]);
        });
        $queries = DB::getQueryLog();
     
        return $department->delete();
    }
    public function getAll()
    {
        return Department::all();
    }
}
