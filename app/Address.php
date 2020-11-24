<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Address extends Model
{
    use Searchable;

    protected $fillable = [
        'address', 'lat', 'lng'
    ];

    public function flats() {
        return $this->hasMany('App\Flat');
    }
}
