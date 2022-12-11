<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'rooms_number',
        'beds_number',
        'bath_number',
        'meters',
        'address',
        'latitude',
        'longitude',
        'city',
        'image',
        'visible',
        'price',
        'user_id'
    ];

    public function services(){
        return $this->belongsToMany('App\Service');
    }

    public function sponsors(){
        return $this->belongsToMany('App\Sponsor')
            ->withPivot(['expire_date'])->orderBy('expire_date');
            //->withTimestamp();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function views(){
        return $this->hasMany('App\View');
    }

    public function getPicPathAttribute(){
        if (substr($this->image, 0, 4) === 'http') {
            return $this->image;
        } else {
            return Storage::url($this->image);
        }
    }

    protected $appends = ['pic_path'];
}
