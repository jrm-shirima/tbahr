<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class EmployeeController extends Controller
{
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
         return view('employees.create');
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
                'education' => 'required|before:tomorrow',
                'registration_status' => 'required'                
            ]);
            if (!$validator->fails()){
                $employee             =  new Employee();
                
                $employee->first_name =  $request->first_name;
                $employee->last_name  =  $request->last_name;
                $employee->gender     =  $request->gender;
                $employee->email      =  $request->email;
                $employee->marital_status =  $request->first_name;
                $employee->dob            =  $request->dob;
                $employee->education      =  $request->education;
                $employee->registration_status =  $request->registration_status;
                $employee->certifications     =  $request->certifications;
                $employee->save();
            
            
            
            
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
            
            $records["data"][] = array(
                $employee->first_name.' '.$employee->last_name,
                $employee->gender,
                $employee->marital_status,
                $employee->education,
                $employee->registration_status,
                '<span id="'.$employee->id.'">
                    <a href="#" title="View more Employee details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
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
    public function show(Employee $employee){
        //
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
