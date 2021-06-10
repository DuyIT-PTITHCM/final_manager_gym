<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uploadimg extends Model
{
    protected $fillable = ['user_id','img','status'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
