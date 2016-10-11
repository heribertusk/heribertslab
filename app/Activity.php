<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  public $table = 'activities';

  public $guarded = [
    'id','created_at','updated_at'
  ];
}
