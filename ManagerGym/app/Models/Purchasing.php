<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    protected $fillable=['name','address','phone'];
    public $table='purchasings';
    public function devices(){
        return $this->hasMany('App\models\Device');
    }
}
