<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Region;
use DB;
use App\EmployeeParticular;
use App\Profession;
use App\ProfessionRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Chartjs;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

              // ExampleController.php

         $employees = app()->chartjs
                 ->name('all_employees')
                 ->type('pie')
                 ->size(['width' => 400, 'height' => 200])
                 ->labels(['Engineers', 'Architects', 'Quantity Surveyors', 'Accountants', 'Others'])
                 ->datasets([
                     [
                         'backgroundColor' => ['#FF6384', '#1ABB9C','#E74C3C','#9B59B6','#31708f'],
                         'hoverBackgroundColor' =>  ['#FF6384', '#1ABB9C','#E74C3C','#9B59B6','#31708f'],
                         'data' => [200, 200,100,20,180]
                     ]
                 ])
                 ->options([
                   'title'=>array(
                     'display' => true,
                     'text'=>'All Employees',
                     'fontSize'=>25,
                     'padding' =>30,
                     'fontStyle'=>'bold',
                     'position'=>'left',
                     'fontFamily'=>"'Arial', sans-serif"
                   ),
                   'legend'=> array(
                     'display' => true,
                     'position'=>'right'
                   ),
                   'layout'=>array(
                     'padding'=>array(
                          'left'=> 0,
                          'right'=> 0,
                          'top'=> 0,
                          'bottom'=> 0
                     )
                   )
                 ]);
             $mData = $this->getRegionsAndAssociateEmployeesNum();
             $regions = app()->chartjs
                         ->name('region_employees')
                         ->type('horizontalBar')
                         ->size(['width' => 400, 'height' => 200])
                         ->labels($mData['regions'])
                         ->datasets([
                             [
                                 "label" => "Regional Employees",
                                 'backgroundColor' => ['rgba(255, 99, 132, 0.9)', 'rgba(54, 162, 235, 0.9)'],
                                 'data' => $mData['employees']
                             ]
                         ])
                         ->options([
                           'title'=>array(
                             'display' => true,
                             'text'=>'Regional Employees',
                             'fontSize'=>25,
                             'padding' =>30,
                             'position'=>'left',
                             'fontStyle'=>'bold',
                             'fontFamily'=>"'Arial', sans-serif"
                           ),
                           'legend'=> array(
                             'display' => false,
                             'position'=>'right'
                           ),
                           'layout'=>array(
                             'padding'=>array(
                                  'left'=> 0,
                                  'right'=> 0,
                                  'top'=> 0,
                                  'bottom'=> 0
                             )
                           )
                         ]);
         $empCatPercentages = $this->getEmployeCategoriesPercentages();
         Log::info($empCatPercentages);
        return view('index', compact('employees','regions','empCatPercentages'));
    }

    public function getRegionsAndAssociateEmployeesNum(){
         $data = array(
            'regions'=>array(),
            'employees'=>array()
         );
         $regions  = Region::all();

         foreach ($regions as $key => $region) {
           $data['regions'][] = $region->region;
           $data['employees'][] = $this->getNumOfEmployeesByRegion($region->region);
         }
      return $data;
    }

    public function getNumOfEmployeesByRegion($region){
      $employeeParticulars  = EmployeeParticular::all();
      $count      = 0;
      foreach ($employeeParticulars as $key => $employeeParticular) {
          if($employeeParticular->region == $region){
            $count++;
          }
      }
      return $count;
    }
    //Load all employees, and number of each category
    public function getEmployeesCategories(){
        $numPermanent   = 0;
        $numTempory     = 0;
        $numInternship  = 0;

      $employeeParticulars  = EmployeeParticular::all();
      $count      = 0;
      foreach ($employeeParticulars as $key => $employeeParticular) {
          switch($employeeParticular->employment_type){
                case 'Permanent':
                     $numPermanent++;
                  break;
                case 'Temporary':
                     $numTempory++;
                  break;
                case 'Internship':
                     $numInternship++;
                  break;
          }
      }
      $data = array(
        'all_employees' =>count($employeeParticulars),
        'permanent'=>$numPermanent,
        'temporary'=>$numTempory,
        'internship'=>$numInternship
      );


      return $data;
    }
   //Get the employee category percentages
    public function getEmployeCategoriesPercentages(){

      $employeesCategories = $this->getEmployeesCategories();
      $all  =         ($employeesCategories['all_employees']/$employeesCategories['all_employees']) * 100;
      $permanent  =   ($employeesCategories['permanent']/$employeesCategories['all_employees']) * 100;
      $temporary  =   ($employeesCategories['temporary']/$employeesCategories['all_employees']) * 100;
      $internship =   ($employeesCategories['internship']/$employeesCategories['all_employees']) * 100;

      return array(
        'all'=> $all,
        'permanent'=>$permanent,
        'temporary'=>$temporary,
        'internship'=>$internship
      );

    }
}
