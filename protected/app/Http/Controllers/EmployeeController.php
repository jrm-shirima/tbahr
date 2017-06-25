<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Region;
use DB;
use App\EmployeeParticular;
use App\Profession;
use App\ProfessionRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class EmployeeController extends Controller
{
   
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $professions      = Profession::all();  
        $professionRegs   = ProfessionRegistration::all();
        $regions          = Region::all();
       return view('employees.create', compact('regions','professions','professionRegs'));
    }

    /*
     *Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'marital_status' => 'required',
                'email' => 'required',
                'marital_status' => 'required',
                'dob' => 'required',
                'employment_date' => 'required',
                'phone' => 'required',
                'employment_type' => 'required',
                'education' => 'required|before:tomorrow',
                'registration_status' => 'required',                
                'profession' => 'required'                
            ]);
            if (!$validator->fails()){
                $employee             =  new Employee();
                $employee->first_name =  $request->first_name;
                $employee->last_name  =  $request->last_name;
                $employee->gender     =  $request->gender;
                $employee->email      =  $request->email;
                $employee->marital_status  =  $request->marital_status;
                $employee->dob             =  $request->dob;
                $employee->phone           =  $request->phone;
                $employee->save();
            
            
                $employeeParticular  =  new EmployeeParticular();
                $employeeParticular->employee_id = $employee->id  ;
                $employeeParticular->employment_type =  $request->employment_type;
                $employeeParticular->employment_date =  $request->employment_date;
                $employeeParticular->education       =  $request->education;
                $employeeParticular->registration_status =  $request->registration_status;
                $employeeParticular->profession =  $request->profession;
                $employeeParticular->region     =  $request->region;
                $employeeParticular->save();
                
                
                
                
                
                return Response::json(array(
                    'success' => true,
                    'data' => []
                ), 200); 
            
            
            } else {
               
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400);                // 400 being the HTTP code for an invalid request.
                   
            }
        }catch (\Exception $ex){
            
            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
        }
    }
    public function  getJSonEmployeesData(){
        //
        $employees = Employee::orderBy('first_name','ASC')->get();
        $iTotalRecords =count(Employee::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
        foreach($employees as $employee) {
            
            $employeeParticular = $employee->employeeParticulars;
            $records["data"][] = array(
                $employee->first_name.' '.$employee->last_name,
                $employeeParticular->region,
                $employeeParticular->profession,
                $employeeParticular->education,
                $employeeParticular->registration_status,
                '<span id="'.$employee->id.'">
                    <a href="'.url("employees").'/'.$employee->id.'" title="View more Employee details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                   </span>',
                
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        
        //Show name, Registration status, retirement Date, Profession, Region
        $employee = Employee::find($id);
        $employeeParticular = $employee->employeeParticulars;
       
        return view('employees.show',compact('employee','employeeParticular'));
    }
    public function showEmployeesByProfession($id){
         $profession = Profession::find($id);
         
        return view('employees.profession', compact('profession')); 
    }
    
    public function getJSONEmployeesByProfession($id){
        $profession = Profession::find($id);
        $employeeParticulars = DB::table('employee_particulars')->where('profession', '=', $profession->profession_name)->get();
        
        $iTotalRecords =count($employeeParticulars);
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
       foreach($employeeParticulars as $key => $employeeParticular){
            $employee   = Employee::find($employeeParticular->employee_id);    
            $employeeParticular = $employee->employeeParticulars;
           
            $records["data"][] = array(
                $employee->first_name.' '.$employee->last_name,
                $employeeParticular->region,
                $employeeParticular->profession,
                $employeeParticular->education,
                $employeeParticular->registration_status,
                '<span id="'.$employee->id.'">
                    <a href="'.url("employees").'/'.$employee->id.'" title="View more Employee details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                   </span>',
                
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    public function showEmployeesByProfessionRegStatus($id){
         $professionReg = ProfessionRegistration::find($id);
         
        return view('employees.profession_registration_status', compact('professionReg')); 
    }
    
    public function getJSONEmployeesByProfessionRegStatus($id){
        $professionReg = ProfessionRegistration::find($id);
        $employeeParticulars = DB::table('employee_particulars')->where('registration_status', '=', $professionReg->profession_reg_name)->get();
        
        $iTotalRecords =count($employeeParticulars);
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
       foreach($employeeParticulars as $key => $employeeParticular){
            $employee   = Employee::find($employeeParticular->employee_id);    
            $employeeParticular = $employee->employeeParticulars;
           
            $records["data"][] = array(
                $employee->first_name.' '.$employee->last_name,
                $employeeParticular->region,
                $employeeParticular->profession,
                $employeeParticular->education,
                $employeeParticular->registration_status,
                '<span id="'.$employee->id.'">
                    <a href="'.url("employees").'/'.$employee->id.'" title="View more Employee details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                   </span>',
                
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee){
        //
    }
    
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
    
}
