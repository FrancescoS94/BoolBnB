<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'end_rate'
    ];

    public function flat() {
        return $this->belongsTo('App\Flat');
    }

    public function rate() {
        return $this->belongsTo('App\Rate');
    }
}
