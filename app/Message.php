<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email', 'request', 'viewed'
    ];

    public function flat() {
        return $this->belongsTo('App\Flat');
    }
}
