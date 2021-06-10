<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevicePartner extends Model
{
    protected $fillable = ['partner_id','device_id','price','service_id','enddate'];
    public $table ='device_partners';

    public function service(){
        return $this->belongsTo('App\Models\Service');
    }
}
