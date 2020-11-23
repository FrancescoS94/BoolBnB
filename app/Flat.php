<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Flat extends Model
{
    // use Searchable;

    protected $fillable = [
        'title','room', 'bed', 'wc', 'mq', 'image', 'description'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function services() {
        return $this->belongsToMany('App\Service');
    }

    public function payments() {
        return $this->hasMany('App\Payment');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function address() {
        return $this->belongsTo('App\Address');
    }

    public function searchableAs() // cerca
    {
        return 'title'; // nome colonna table appartamenti
    }
    
    public function views() {
        return $this->hasMany('App\View');
    }

}
