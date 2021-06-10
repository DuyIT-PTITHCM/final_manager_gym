<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Department;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Json;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleId  = Role::where('name','admin')->first()->id;
        return  User::with('department','role')->where('role_id','<>',$roleId)->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user->role->name !='admin'){
            return User::with('role','department')->where('id',$user->id)->get();
        }else{
            return response()->json(['message'=>'ID không tồn tại'],402);
        }
      
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        return $user->update(request()->only('name','role_id','phone','image'));
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->role->name!='admin'){
            Department::where('id',$user->department_id)->update([
                'user_id'=>null
            ]);
            return $user->delete();
        }else{
            return response()->json([],401);
        }
    }
    public function getAll(){
        return User::all();
    }
    public function changePassword(ChangePasswordRequest $request){
        $listInput = $request->only('old_password','new_password');
         $userLogin =  Auth::user();
         if (Hash::check(($listInput['old_password']) ,$userLogin->password)) {
            $userLogin->password = Hash::make($listInput['new_password']);
            $userLogin->save();
            return response()->json([
                'error'=>false,
                'data'=>'ok',
                'status'=>200
            ]);
        }
        return response()->json([
            'error'=>true,
            'data'=>'not ok',
            'status'=>500
        ]);
    }
}
