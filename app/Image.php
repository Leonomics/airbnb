<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{   
    protected $fillable = [
        'path',
        'apartment_id',
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }

    public function getImgPathAttribute(){
        return Storage::url($this->path); 
    }

    public $appends = ['img_path'];
}
