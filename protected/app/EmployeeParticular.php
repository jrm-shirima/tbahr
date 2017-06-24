<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeParticular extends Model
{
    public function employee(){
        return $this->belongTo('\App\Employee','employee_id');
    }
}
