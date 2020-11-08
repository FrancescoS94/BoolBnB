<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function flats() {
        return $this->hasMany('App\Flat');
    };
}
