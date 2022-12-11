<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = [
        'text',
        'name',
        'surname',
        'viewed',
        'email',
        'apartment_id'
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
