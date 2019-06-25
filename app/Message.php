<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [

    'user_id',
    'name',
    'lastname',
    'email',
    'title',
    'content',
  ];

  function user() {

    return $this->belongsTo(User::class);
  }

  function apartment() {

    return $this->belongsTo(Apartment::class);
  }
}
