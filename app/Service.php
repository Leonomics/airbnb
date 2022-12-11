<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const AVAILABLE_SERVICE = [ 'WiFi', 'Posto Macchina', 'Piscina', 'Portineria', 'Sauna', 'Vista Mare'];

    public function apartments(){
        return $this->belongsToMany('App\Apartment');
    }
}
