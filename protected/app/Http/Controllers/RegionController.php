<?php

namespace App\Http\Controllers;

use App\Region;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class RegionController extends Controller
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
         return view('regions.index');
    }

    public function  getJSonRegionsData(){
        //
        $regions = Region::orderBy('region','ASC')->get();

        $iTotalRecords =count(Region::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count=1;
        foreach($regions as $region) {

            $records["data"][] = array(
                $count++,
                $region->region,
                $this->getNumberOfAssignedEmployee($region->region),
                '<span id="'.$region->id.'">
                  <a href="'.url("employees/region").'/'.$region->id.'" title="View Employees available in {$region->region}" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                   </span>',
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regions.create');
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
                'region' => 'required',
            ]);
            if (!$validator->fails()){
                $region             =  new Region();
                $region->region      =  $request->region;
                $region->save();

                return Response::json(array(
                    'success' => true,
                    'errors' => []
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
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }

    public function getNumberOfAssignedEmployee($region_name){

      $employees = Employee::all();
      $count     = 0;

      foreach($employees as $employee){
          $employeeParticular  = $employee->employeeParticular;
          $region  = Region::find($employeeParticular->region_id);
          if($region->region == $region_name){
              $count++;
          }
      }
    return $count;

   }
}
