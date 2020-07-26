<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function bill(){

      return $this->belongsTo('App\Bill');
    }
}
