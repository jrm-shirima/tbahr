<?php

namespace App\Http\Controllers;

use App\Profession;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class ProfessionController extends Controller
{
    public function __construct(){
         $this->middleware('guest');
     }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professions.create');
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
                'profession_name' => 'required'
                           
            ]);
            if (!$validator->fails()){
                $profession             =  new Profession();
                $profession->profession_name =  $request->profession_name;
                $profession->save();
            
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
   
     public function  getJSonProfessionsData(){
        //
        $professions = Profession::orderBy('id','ASC')->get();
        $iTotalRecords =count(Profession::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
        foreach($professions as $profession) {
            
            $records["data"][] = array(
                $count++,
                $profession->profession_name,
                $this->getNumberOfAssignedEmployee($profession->profession_name),                
                '<span id="'.$profession->id.'">
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
     * @param  \App\Professional $professional
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Professional $professional
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    { //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Professional $professional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Professional $professional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        //
    }
     public function getNumberOfAssignedEmployee($profession){
     
        $employees = Employee::all();
        $count     = 0;
        foreach($employees as $employee){
            if($employee->profession == $profession){
                $count++;
            }                    
        }
      return $count;  
     
   }
}
