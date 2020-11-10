<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'price', 'hours'
    ];

    public function payments() {
        return $this->hasMany('App\Payment');
    }
}
