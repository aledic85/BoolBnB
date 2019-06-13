<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsored extends Model
{
    protected $fillable = [

      'title',
      'price',
      'end_sponsored'
    ];


    function apartments() {

      return $this->belongsToMany(Apartment::class);
    }
}
