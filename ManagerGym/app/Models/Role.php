<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    //
    public $table = 'roles';
    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
