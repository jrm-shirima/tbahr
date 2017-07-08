<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Region;
use DB;
use Auth;
use App\EmployeeParticular;
use App\Profession;
use App\ProfessionRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;


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
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required',
                'marital_status' => 'required',
                'email'      => 'required|string|email|max:255|unique:employees',
                'marital_status' => 'required',
                'dob' => 'required|date',
                'employment_date' => 'required|date',
                'phone' => 'required',
                'employment_type' => 'required|string|max:255',
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
                $employeeParticular->prof_reg_status_id =  $request->registration_status;
                $employeeParticular->profession_id =  $request->profession;
                $employeeParticular->region_id     =  $request->region;
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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    public function  getJSonEmployeesData(){
        //
        $employees = Employee::orderBy('first_name','ASC')->get();
        $iTotalRecords =count(Employee::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
        foreach($employees as $employee) {
          Log::info($this->getListOfEmployees($employee));
            $records["data"][] = $this->getListOfEmployees($employee);
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
        $employeeParticular = $employee->employeeParticular;
        $region      = Region::find($employeeParticular->region_id);
        $profession  = Profession::find($employeeParticular->profession_id);
        $professionRegistration = ProfessionRegistration::find($employeeParticular->prof_reg_status_id);

        return view('employees.show',compact('employee','employeeParticular','region','profession','professionRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function showEmployeesByRegion($id){
      $region = Region::find($id);

     return view('employees.region', compact('region'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function showEmployeesByProfession($id){
         $profession = Profession::find($id);

        return view('employees.profession', compact('profession'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function getJSONEmployeesByRegion($id){
      $region = Region::find($id);
      $employeeParticulars = EmployeeParticular::where('region_id', '=', $region->id)->get();
      $iTotalRecords =count($employeeParticulars);
      $sEcho = intval(10);
      $records = array();
      $records["data"] = array();
      $count=1;
     foreach($employeeParticulars as $key => $employeeParticular){
          $employee   = Employee::find($employeeParticular->employee_id);
          $employeeParticular = $employee->employeeParticulars;
          $records["data"][] = $this->getListOfEmployees($employee);
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
    public function getJSONEmployeesByProfession($id){
        $profession = Profession::find($id);
        $employeeParticulars = EmployeeParticular::where('profession_id', '=', $profession->id)->get();

        $iTotalRecords =count($employeeParticulars);
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
       foreach($employeeParticulars as $key => $employeeParticular){
            $employee   = Employee::find($employeeParticular->employee_id);
            $employeeParticular = $employee->employeeParticulars;
            $records["data"][] = $this->getListOfEmployees($employee);
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
    public function showEmployeesByProfessionRegStatus($id){
         $professionReg = ProfessionRegistration::find($id);

        return view('employees.profession_registration_status', compact('professionReg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    public function getJSONEmployeesByProfessionRegStatus($id){
        $professionReg = ProfessionRegistration::find($id);
        $employeeParticulars = EmployeeParticular::where('prof_reg_status_id', '=', $professionReg->id)->get();

        $iTotalRecords =count($employeeParticulars);
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
       foreach($employeeParticulars as $key => $employeeParticular){
            $employee   = Employee::find($employeeParticular->employee_id);
            $employeeParticular = $employee->employeeParticulars;
            $records["data"][] = $this->getListOfEmployees($employee);
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Employee  $id
     * @return View with Response
     */
    public function edit($id){
        $employee = Employee::find($id);
        $employeeParticular = $employee->employeeParticular;
        $professions      = Profession::all();
        $professionRegs   = ProfessionRegistration::all();
        $regions          = Region::all();
      return view('employees.edit', compact('employee','employeeParticular','regions','professions','professionRegs'));
    }

    public function postUpdateEmployee(Request $request, $id){

      try {
          $validator = Validator::make($request->all(), [
              'first_name' => 'required|string|max:255',
              'last_name' => 'required|string|max:255',
              'gender' => 'required',
              'marital_status' => 'required',
              'marital_status' => 'required',
              'dob' => 'required|date',
              'employment_date' => 'required|date',
              'phone' => 'required',
              'employment_type' => 'required|string|max:255',
              'education' => 'required|before:tomorrow',
              'registration_status' => 'required',
              'profession' => 'required'
          ]);
          if (!$validator->fails()){
              $employee             =  Employee::find($id);
              $employee->first_name =  $request->first_name;
              $employee->last_name  =  $request->last_name;
              $employee->gender     =  $request->gender;
              $employee->marital_status  =  $request->marital_status;
              $employee->dob             =  $request->dob;
              $employee->phone           =  $request->phone;
              $employee->save();


              $employeeParticular  =  EmployeeParticular::find($employee->employeeParticular->id);
              $employeeParticular->employee_id = $employee->id  ;
              $employeeParticular->employment_type =  $request->employment_type;
              $employeeParticular->employment_date =  $request->employment_date;
              $employeeParticular->education       =  $request->education;
              $employeeParticular->prof_reg_status_id =  $request->registration_status;
              $employeeParticular->profession_id =  $request->profession;
              $employeeParticular->region_id     =  $request->region;
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
    public function deleteEmployee($id){
        $employee = Employee::find($id);
        $employee->delete();
      return redirect('employees/');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function getListOfEmployees(Employee $employee){

      $employeeParticular = $employee->employeeParticular;
      $region      = Region::find($employeeParticular->region_id);
      $profession  = Profession::find($employeeParticular->profession_id);
      $professionRegistration = professionRegistration::find($employeeParticular->prof_reg_status_id);

        $edit = "";

        if(Auth::user()->can('read') && !Auth::user()->can('write','modify','fullcontrol')){
          $edit  = '';
        }elseif (Auth::user()->can('read','write') && !Auth::user()->can('modify','fullcontrol')) {
          $edit  = '';
        }elseif (Auth::user()->can('read','write','modify')  && !Auth::user()->can('fullcontrol')) {

          $edit  = '<span id="'.$employee->id.'">
                    <a href="'.url("employees").'/'.$employee->id.'/edit" title="Edit" class="btn btn-icon-only"><i title="Edit" class="fa fa-pencil" aria-hidden="true"></i></a>
                   </span>';
        }elseif(Auth::user()->can('read','write','modify','fullcontrol')){

          $edit  = '<span id="'.$employee->id.'">
                    <a href="'.url("employees").'/'.$employee->id.'/edit" title="Edit" class="btn btn-icon-only"><i title="Edit" class="fa fa-pencil" aria-hidden="true"></i></a>
                   </span>';
        }



      return array(
          $employee->first_name.' '.$employee->last_name,
          $region->region,
          $profession->profession_name,
          $employeeParticular->education,
          $professionRegistration->profession_reg_name,
          '<span id="'.$employee->id.'">
              <a href="'.url("employees").'/'.$employee->id.'" title="View" class="btn btn-icon-only"> <i class="fa fa-eye text-primary"  title="View" aria-hidden="true"></i></a>
             </span>'
             .$edit,

      );
    }
}
