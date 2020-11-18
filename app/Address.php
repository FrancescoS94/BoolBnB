<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country', 'address', 'lat', 'lng'
    ];


    public function flats() {
        return $this->hasMany('App\Flat');
    }
}
