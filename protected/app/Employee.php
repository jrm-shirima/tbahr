<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function employeeParticular(){
        return $this->hasOne('\App\EmployeeParticular', 'employee_id');
    }
}
