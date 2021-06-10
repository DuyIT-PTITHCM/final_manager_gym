<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    
    protected $fillable =['name'];
    public $table ='services';

    public function devicepartners(){
        return $this->hasMany('App\Models\DevicePartner');
    }
}
