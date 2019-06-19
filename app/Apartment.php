<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = [

    'title',
    'description',
    'rooms',
    'beds',
    'bathrooms',
    'mq',
    'address',
    'latitude',
    'longitude',
    'img_path',
    'wi_fi',
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

  function sponsoreds() {

    return $this->belongsToMany(Sponsored::class);
  }

  public function scopeActive($query)
  {
    return $query->where('active', 1);
  }
}
