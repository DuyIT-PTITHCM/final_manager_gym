<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $table ='departments';
    protected $fillable =['name','user_id'];
    public function user(){
        return $this->hasOne('App\User'); 
    }
    public function devices(){
        return $this->hasMany('App\Models\Device');
    }
    //
}
