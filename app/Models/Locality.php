<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    public function province(){
        return $this->belongsTo('App\Models\Province');
    }
}