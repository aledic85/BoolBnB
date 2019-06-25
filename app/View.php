<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [

      'ip',
      'apartment_id'
    ];

    function apartment() {

      return $this->belongsTo(Apartment::class);
    }
}
