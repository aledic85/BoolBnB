<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = [

    'title',
    'rooms',
    'beds',
    'bathrooms',
    'mq',
    'latitude',
    'longitude',
    'img_path',
    'wi-fi',
    'parking_space',
    'pool',
    'sauna',
    'active',
    'sponsored',
    'user_id'
  ];

  function user() {

    return $this->belongsTo(User::class);
  }
}
