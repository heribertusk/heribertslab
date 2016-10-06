<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  public $table = 'employees';

  public $guarded = [
    'id','created_at','updated_at'
  ];
}
