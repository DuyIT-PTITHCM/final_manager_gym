<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    public $table ='statuses';
    protected $fillable = ['name'];
    public function devices(){
        return $this->hasMany('App\Models\Device','status_id');
    }
}
