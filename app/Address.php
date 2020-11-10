<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country', 'city', 'address', 'cap', 'district'
    ];

    public function flats() {
        return $this->hasMany('App\Flat');
    }
}
