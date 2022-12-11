<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function apartments(){
        return $this->belongsToMany('App\Apartment')->withPivot('aparment_id', 'sposnor_id', 'expire_date');
    }
}
