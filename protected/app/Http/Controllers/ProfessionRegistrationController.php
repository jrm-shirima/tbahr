<?php

namespace App\Http\Controllers;

use App\ProfessionRegistration;
use App\Employee;
use App\EmployeeParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class ProfessionRegistrationController extends Controller
{
    public function __construct(){
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        return view('profession_registrations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('profession_registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'prf_reg_name' => 'required'

            ]);
            if (!$validator->fails()){
                $professionReg             =  new ProfessionRegistration();
                $professionReg->profession_reg_name =  $request->prf_reg_name;
                $professionReg->save();

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

     public function  getJSonProfessionRegistrationsData(){
        //
        $professionRegs = ProfessionRegistration::orderBy('id','ASC')->get();
        $iTotalRecords =count(ProfessionRegistration::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
        foreach($professionRegs as $profession) {

            $records["data"][] = array(
                $count++,
                $profession->profession_reg_name,
                $this->getNumberOfAssignedEmployee($profession->profession_reg_name),
                '<span id="'.$profession->id.'">
                    <a href="'.url("employees/registration-status").'/'.$profession->id.'"  title="View more Employee details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getNumberOfAssignedEmployee($profession){

        $employees = Employee::all();
        $count     = 0;

        foreach($employees as $employee){
            $particular  = $employee->employeeParticulars;

            if($particular->registration_status == $profession){
                $count++;
            }
        }
      return $count;

   }
}
