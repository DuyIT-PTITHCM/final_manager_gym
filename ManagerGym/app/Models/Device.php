<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $with =['status','department','typemachine'];
    public $table ='devices';
    protected $fillable =['name','img','type_machine_id','status_id','department_id','supplier_id','purchasing_id','pricebuy','pricesales'];
    public function typemachine(){
        return $this->belongsTo('App\Models\TypeMachine','type_machine_id');
    }
    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
    public function department(){
        return $this->belongsTo('App\Models\Department');
    }
    public function partners(){
        return $this->belongsToMany('App\models\Partner','device_partners','device_id','partner_id');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public function purchasing(){
        return $this->belongsTo('App\Models\Purchasing');
    }
}
