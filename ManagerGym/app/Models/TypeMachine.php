<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMachine extends Model
{
    //
    public $table ='type_machines';
    protected $fillable = ['name'];
    public function devices(){
        return $this->hasMany('App\Models\Device');
}
}