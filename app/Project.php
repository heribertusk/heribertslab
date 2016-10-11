<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  public $table = 'projects';

  public $guarded = [
    'id','created_at','updated_at'
  ];
}
