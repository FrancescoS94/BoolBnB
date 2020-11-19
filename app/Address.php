<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address', 'lat', 'lng'
    ];

    public function flats() {
        return $this->hasMany('App\Flat');
    }
}
