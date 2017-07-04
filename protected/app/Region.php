<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  public function employeeParticular(){
      return $this->belongTo('\App\EmployeeParticular','region_id');
  }
}
