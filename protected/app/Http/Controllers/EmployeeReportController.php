<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Region;
use DB;
use App\EmployeeParticular;
use App\Profession;
use App\ProfessionRegistration;
use Illuminate\Http\Request;

class EmployeeReportController extends Controller{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
     $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
        $professions      = Profession::all();
        $professionRegs   = ProfessionRegistration::all();
        $regions          = Region::all();
       
    return view('report.index', compact('regions','professions','professionRegs'));
  }

  public function getJSONEmployeesByFilter($reg_status,$wStation,$emp_type){
        $data = array($reg_status,$wStation,$emp_type);
      
        if( empty($wStation) && empty($reg_status) && empty($emp_type)){
            
            if(!is_numeric($wStation)){
                 $wStation  = 0;  
             }
          
            if(!is_numeric($reg_status)){
                 $reg_status = 0;
            }
           
            if($emp_type == 'employee-all'){
                $emp_type= 0;
            }
            
       
            
            
        if($reg_status != 0 ){ $professionReg  = ProfessionRegistration::find($reg_status);}       
        if($emp_type != 0 ){ $employmentType = $emp_type; }
        if($wStation != 0 ){ $region = Region::find($wStation);}
        
            
        $employeeParticulars = DB::table('employee_particulars')->where('registration_status', '=', $professionReg->profession_reg_name)->get();

      
      
      
      
      
       $particular   = EmployeeParticular 
        }
      
      
      
       
      
      
      //$employee = Employee:all();
      
      
      
      echo json_encode($data);
      

  }

}
