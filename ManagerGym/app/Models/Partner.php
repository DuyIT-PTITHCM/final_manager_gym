<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    //
    protected $fillable=['name','address','phone'];
    public $table='partners';
    public function devices(){
        return $this->belongsToMany('App\models\Device','device_partners','partner_id','device_id');
    }
}
