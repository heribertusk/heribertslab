<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountCode extends Model
{
  public $table = 'account_codes';

  public $guarded = [
    'id','created_at','updated_at'
  ];
}
