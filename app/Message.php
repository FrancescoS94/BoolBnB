<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'lastname', 'email', 'request', 'viewed'
    ];

    public function flat() {
        return $this->belongsTo('App\Flat');
    }
}
