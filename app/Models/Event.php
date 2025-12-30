<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  protected $fillable = ['title', 'start_at', 'end_at', 'notes'];
  public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
