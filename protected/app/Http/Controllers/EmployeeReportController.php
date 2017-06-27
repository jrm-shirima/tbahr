<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Region;
use App\Helpers\Helper;
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
    // $this->middleware('auth');
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
    
   public function getJSONEmployees(){
     
        //
        $employees = Employee::orderBy('first_name','ASC')->get();
        
         $data = array();
        foreach($employees as $employee) {

            $employeeParticular = $employee->employeeParticulars;
             array_push( 
                $data,   
                array(
                     $employee->first_name.' '.$employee->last_name,
                     $employee->phone,
                     $employeeParticular->education,
                     $employeeParticular->profession,
                     $employeeParticular->employment_type,
                     $employeeParticular->registration_status, 
                     $employeeParticular->region,
                     Helper::getRetirementDate($employee->dob)         
                )
            ); 
        }
        
        echo json_encode($data);       
   }
    
    
  public function getJSONEmployeesByFilter($reg_status,$wStation,$emp_type,$requestBy){
      echo json_encode($this->processRequest($reg_status,$wStation,$emp_type,$requestBy));
  }
  public function processRequest($reg_status,$wStation,$emp_type,$requestBy){
       
      
      $data = array();
      if( !empty($wStation) && !empty($reg_status) && !empty($emp_type)){
            
            if(!is_numeric($wStation)){
                 $wStation  = 0;  
             }
          
            if(!is_numeric($reg_status)){
                 $reg_status = 0;
            }
            if($emp_type == 'employee-all'){
                $emp_type= 0;
            } 
          
      $rs = array();
      $professionReg   = ProfessionRegistration::find($reg_status);
      $region          = Region::find($wStation);
      $employmentType  = $emp_type;
      
       switch($requestBy){
                
          case 'registration_status' :
             if($reg_status){ 
                 
                 $particulars = $this->loadDataByFilter('registration_status', $professionReg->profession_reg_name);
                 $data = $this->processResult($particulars);
               
                 if($wStation && $emp_type ){
                   
                    $rs = $this->re_process($data,$region->region, $employmentType);
                
                 }elseif(!$wStation  && !$emp_type){
                    $rs =  $data;
                    
                 }elseif(!$wStation  && $emp_type){
                    $rs = $this->re_process($data, 0, $employmentType);
                    
                 }elseif($wStation != 0  && $emp_type == 0){
                   $rs = $this->re_process($data,$region->region, 0);
                 } 
                
                return $rs; 
             }else{
                $particulars = $this->loadDataByFilter('registration_status', 'all');
                 $data = $this->processResult($particulars);
               
                 if($wStation && $emp_type ){
                   
                    $rs = $this->re_process($data,$region->region, $employmentType);
                
                 }elseif(!$wStation  && !$emp_type){
                    $rs =  $data;
                    
                 }elseif(!$wStation  && $emp_type){
                    $rs = $this->re_process($data, 0, $employmentType);
                    
                 }elseif($wStation != 0  && $emp_type == 0){
                   $rs = $this->re_process($data,$region->region, 0);
                 } 
                
                return $rs; 
            }
            break;
          case 'region' :
          
            if($wStation){ 
                 
                 $particulars     = $this->loadDataByFilter('region', $region->region);
                 $data            = $this->processResult($particulars);
                
                 if($emp_type  && $reg_status ){
                   
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, $employmentType);
                    
                 }elseif(!$emp_type  && !$reg_status){
                    $rs = $data;
                 }elseif(!$emp_type && $reg_status){
                    
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, 0);
                 }elseif($emp_type  && !$reg_status){
                     $rs = $this->re_process($data, 0, $employmentType);
                 }
                 
                return $rs; 
             }else{
                
                 $particulars     = $this->loadDataByFilter('region', 'all');
                 $data            = $this->processResult($particulars);
                
                 if($emp_type  && $reg_status ){
                   
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, $employmentType);
                    
                 }elseif(!$emp_type  && !$reg_status){
                    $rs = $data;
                 }elseif(!$emp_type && $reg_status){
                    
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, 0);
                 }elseif($emp_type  && !$reg_status){
                     $rs = $this->re_process($data, 0, $employmentType);
                 }
                 
                return $rs; 
                
                
                return array();
            }
                break;
          case 'employment_type':
             
            if($emp_type){ 
                 
                 $particulars = $this->loadDataByFilter('employment_type', $emp_type);
                 $data = $this->processResult($particulars);
                
                 if($wStation  && $reg_status ){
                  
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, $region->region);
                                   
                 }elseif(!$wStation  && !$reg_status){
                    $rs = $data;
                 }elseif(!$wStation  && $reg_status){
                    $rs = $this->re_process($data, $professionReg->profession_reg_name, 0);
                    
                 }elseif($wStation  && !$reg_status){
                   $rs = $this->re_process($data, 0, $region->region);
                 }
                
                return $rs; 
             }else{
                 $particulars = $this->loadDataByFilter('employment_type', 'all');
                 $data = $this->processResult($particulars);
                
                 if($wStation  && $reg_status ){
                  
                     $rs = $this->re_process($data, $professionReg->profession_reg_name, $region->region);
                                   
                 }elseif(!$wStation  && !$reg_status){
                    $rs = $data;
                 }elseif(!$wStation  && $reg_status){
                    $rs = $this->re_process($data, $professionReg->profession_reg_name, 0);
                    
                 }elseif($wStation  && !$reg_status){
                   $rs = $this->re_process($data, 0, $region->region);
                 }
                
                return $rs; 
             } 
             break;
        }        
      }else{
         return array();  
      }     
      
  }
 public function loadDataByFilter($column, $value){
     
        if($value == 'all'){
          return DB::table('employee_particulars')
                                       ->where($column, '!=', $value)
                                       ->get();
        }
         return DB::table('employee_particulars')
                                       ->where($column, '=', $value)
                                       ->get();
    }
 public function processResult($particulars){
     $data = array();
     
     foreach($particulars as $employeeParticular):
            $employee   = Employee::find($employeeParticular->employee_id);
          
            array_push( 
                $data,   
                array(
                     $employee->first_name.' '.$employee->last_name,
                     $employee->phone,
                     $employeeParticular->education,
                     $employeeParticular->profession,
                     $employeeParticular->employment_type,
                     $employeeParticular->registration_status, 
                     $employeeParticular->region,
                     Helper::getRetirementDate($employee->dob)         
                )
            ); 
             
                    
     endforeach;
     
     return $data;
 }
public function re_process($employeeParticulars,$param1, $param2){
    $data = '';
    //return array($employeeParticulars,$param1,$param2);  
    if($param1 && $param2){
        $data = array();
        foreach($employeeParticulars as $particular):
        
              if(in_array($param1, $particular) && in_array($param2, $particular)){
                array_push( 
                   $data,
                   $particular
                );

              }

         endforeach;
       
    }elseif(!$param1 && $param2){
        $data = array();
       foreach($employeeParticulars as $particular):
             if(in_array($param2, $particular)){
                array_push( 
                   $data,
                   $particular
                );

              }
         endforeach; 
     
    }elseif($param1 && !$param2){
       $data = array();
       foreach($employeeParticulars as $particular):
            if(in_array($param1, $particular)){
                array_push( 
                   $data,
                   $particular
                );

              }         

       endforeach; 
     
    }
    
  return $data;
}

}
