<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable=['name','address','phone'];
    public $table='suppliers';
    public function devices(){
        return $this->hasMany('App\models\Device');
    }
}
