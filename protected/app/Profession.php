<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
  public function employeeParticular(){
      return $this->belongTo('\App\EmployeeParticular','profession_id');
  }
}
