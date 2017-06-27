<?php

namespace App\Http\Controllers;

use App\EmployeeWorkStation;
use Illuminate\Http\Request;

class EmployeeWorkStationController extends Controller
{
  
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'employee_id' => 'required',
                'region' => 'required',
                'district' => 'required',                           
            ]);
            if (!$validator->fails()){
                $employeeWorkStation             =  new Employee();
                
                $employeeWorkStation->employee_id =  $request->employee_id;
                $employeeWorkStation->region      =  $request->region;
                $employeeWorkStation->district    =  $request->district;
                $employeeWorkStation->save();
            
            
            
            
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
     * Display the specified resource.
     *
     * @param  \App\EmployeeWorkStation  $employeeWorkStation
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeWorkStation $employeeWorkStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeWorkStation  $employeeWorkStation
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeWorkStation $employeeWorkStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeWorkStation  $employeeWorkStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeWorkStation $employeeWorkStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeWorkStation  $employeeWorkStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeWorkStation $employeeWorkStation)
    {
        //
    }
}
