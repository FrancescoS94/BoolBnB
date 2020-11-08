<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function payments() {
        return $this->hasMany('App\Payment');
    };
}
