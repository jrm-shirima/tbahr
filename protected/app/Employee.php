<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function employeeParticulars(){
        return $this->hasOne('\App\EmployeeParticular', 'employee_id');
    }
}
