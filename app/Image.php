<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image'
    ];

    // relazione con il model Flat
    public function flat(){
        return $this->belongsTo('App\Flat');
    }
}
