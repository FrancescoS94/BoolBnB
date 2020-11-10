<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function flat() {
        return $this->belongsTo('App\Flat');
    }

    public function rate() {
        return $this->belongsTo('App\Rate');
    }
}
