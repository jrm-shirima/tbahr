<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionRegistration extends Model
{
  public function employeeParticular(){
      return $this->belongTo('\App\EmployeeParticular','prof_reg_status_id');
  }
}
