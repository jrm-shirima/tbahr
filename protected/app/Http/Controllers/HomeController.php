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
         $empCatPercentages = $this->getEmployeCategoriesPercentages();
         $professionDistribution = $this->getEmployeesProfessionDistributionNum();

         //Create Pie Chart
         $employees = app()->chartjs
                 ->name('all_employees')
                 ->type('pie')
                 ->size(['width' => 400, 'height' => 200])
                 ->labels(['Engineers', 'Architects', 'Quantity Surveyors', 'Accountants', 'Others'])
                 ->datasets([
                     [
                         'backgroundColor' => ['#FF6384', '#1ABB9C','#E74C3C','#9B59B6','#31708f'],
                         'hoverBackgroundColor' =>  ['#FF6384', '#1ABB9C','#E74C3C','#9B59B6','#31708f'],
                         'data' => [
                           $professionDistribution['engineers'],
                           $professionDistribution['architects'],
                           $professionDistribution['quantitySurveyors'],
                           $professionDistribution['accountants'],
                           $professionDistribution['others'],
                        ]
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
                                 'backgroundColor' => $this->getColors($mData['regions']),
                                 'hoverBackgroundColor' => $this->getColors($mData['regions']),
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

        Log::info($professionDistribution);
        return view('index', compact('employees','regions','empCatPercentages','professionDistribution'));
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
    //Get random generated colors
   public function getColors($regions){
      $colors  =  array();
      foreach($regions as $region){
        $colors[] = $this->generateRandomColors();
      }
      return $colors;
  }
  public function generateRandomColors() {
    return '#' .str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
  }


  public function  getEmployeesProfessionDistributionNum(){
          $employees  = $this->getAllEmployees();
          $all        = count($employees);
          $engineers  = 0;
          $architects = 0;
          $quantitySurveyors = 0;
          $accountants   = 0;
          $others = 0;

          $distrubNum = array(
                'all' =>$all,
                'engineers' =>$engineers,
                'architects'=>$architects,
                'quantitySurveyors'=>$quantitySurveyors,
                'accountants'=>$accountants,
                'others'=>$others,
                'data' => array(),
                'compare'=>array()
            );
         //Fill profession to find in this array
          $profDistribution = array(
              'Engineer',
              'rchitect',  //Removed "a" char intentionally to find an occurance the word
              'Surveyor',
              'ccountant', //Removed "a" char intentionally to find an occurance the word
              'Other'
            );
        foreach($employees as $e => $employee) {

              $employeeParticulars = $this->getAllEmployeeParticulars($employee->id);

              foreach ($employeeParticulars as $k => $employeeParticular) {
                $distrubNum['data'][] =$employeeParticular->profession;
                $distrubNum['compare'][] =strripos(trim($employeeParticular->profession),$profDistribution[3],0);
                if(strripos(trim($employeeParticular->profession),$profDistribution[0],0)){
                   $engineers++;
                   $distrubNum['engineers'] =  $engineers;
                }elseif(strripos(trim($employeeParticular->profession),$profDistribution[1],0)){
                   $architects++;
                   $distrubNum['architects'] =  $architects;
                }elseif(strripos(trim($employeeParticular->profession),$profDistribution[2],0)){
                   $quantitySurveyors++;
                    $distrubNum['quantitySurveyors'] =  $quantitySurveyors;
                }elseif(strripos(trim($employeeParticular->profession),$profDistribution[3],0)){
                   $accountants++;
                   $distrubNum['accountants'] = $accountants;
                }else{
                   $others++;
                   $distrubNum['others'] = $others;
                }
              }


        }
      return $distrubNum;
  }

  public function getAllEmployees(){
    return Employee::all();
  }

  public function getAllEmployeeParticulars($id){
    return DB::table('employee_particulars')
                ->where('employee_id', '=', $id)
                ->get();
  }

}
