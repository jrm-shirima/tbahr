<?php
namespace App\Helpers;

use Carbon\Carbon;

class Helper{
    
    
    public static function getRetirementDate($dob){
        return self::calculateRetirementDate($dob);
    }
    
    public static function calculateRetirementDate($dob){
        
        
        $currentAge             = Carbon::parse($dob)->age; 
        $requiredAgeToRetire    = 65;
        $yearDeff               = $requiredAgeToRetire - $currentAge;
        $expectedRetiredDate    = Carbon::now()->addYears($yearDeff);
           
    return Carbon::parse($expectedRetiredDate)->toFormattedDateString();
    }
    
    public static function getFormattedDate($date){
        return Carbon::parse($date)->toFormattedDateString();
    }
}

/*
  $dt = Carbon::parse('2012-9-5 23:26:11.123789');

    // These getters specifically return integers, ie intval()
    var_dump($dt->year);                                         // int(2012)
    var_dump($dt->month);                                        // int(9)
    var_dump($dt->day);                                          // int(5)
    var_dump($dt->hour);                                         // int(23)
    var_dump($dt->minute);                                       // int(26)
    var_dump($dt->second);                                       // int(11)
    var_dump($dt->micro);                                        // int(123789)
    var_dump($dt->dayOfWeek);                                    // int(3)
    var_dump($dt->dayOfYear);                                    // int(248)
    var_dump($dt->weekOfMonth);                                  // int(1)
    var_dump($dt->weekOfYear);                                   // int(36)
    var_dump($dt->daysInMonth);                                  // int(30)
    var_dump($dt->timestamp);                                    // int(1346901971)
    var_dump(Carbon::createFromDate(1975, 5, 21)->age);          // int(41) calculated vs now in the same tz
    var_dump($dt->quarter);                                      // int(3)


*/