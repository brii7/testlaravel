<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{

    protected $fillable = ['state'];

    public function users(){

        return $this->belongsToMany('App\User')->withPivot('state')->withTimestamps();

    }
}
