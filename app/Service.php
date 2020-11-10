<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service'
    ];

    public function flats() {
        return $this->belongsToMany('App\Flat');
    }
}
