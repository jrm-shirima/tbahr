<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeParticular extends Model
{
    public function employee(){
        return $this->belongTo('\App\Employee','id');
    }
    public function profession(){
        return $this->hasOne('\App\Profession', 'id');
    }
    public function professionRegistration(){
        return $this->hasOne('\App\ProfessionRegistration', 'id');
    }
    public function region(){
        return $this->hasOne('\App\Region', 'id');
    }
}
