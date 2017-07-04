<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//Authentication routes
Route::get('admins', array(
'uses' =>'Auth\RegisterController@index',
 'as' => 'admins'
));
Route::get('admins/create', array(
'uses' =>'Auth\RegisterController@create',
 'as' => 'admins/create'
));
Route::post('admins', array(
'uses' =>'Auth\RegisterController@store',
 'as' => 'register'
));
Route::get('get-admins', array(
'uses' =>'Auth\RegisterController@getJsonAdmins',
 'as' => 'get-admins'
));

//Home routes
Route::get('/','HomeController@index');
Route::get('/home','HomeController@index');
Route::get('/index','HomeController@index');
Route::get('/dashboard','HomeController@index');


//Employee routes
Route::resource('employees', 'EmployeeController',['only' => [
    'index', 'show','create','store','edit'
]]);
Route::get('get-employees','EmployeeController@getJSonEmployeesData');
Route::get('employees/profession/{id}','EmployeeController@showEmployeesByProfession');
Route::get('employees/registration-status/{id}','EmployeeController@showEmployeesByProfessionRegStatus');
Route::get('employees/region/{id}','EmployeeController@showEmployeesByRegion');
Route::get('get-employees/profession/{id}','EmployeeController@getJSONEmployeesByProfession');
Route::get('get-employees/registration-status/{id}','EmployeeController@getJSONEmployeesByProfessionRegStatus');
Route::get('get-employees/region/{id}','EmployeeController@getJSONEmployeesByRegion');

//Employee Work Station routes
Route::post('employees/workstation','EmployeeWorkStationController@store');

//EmployeeReport routes
Route::get('employee-report','EmployeeReportController@index');
Route::get('get-employees-report','EmployeeReportController@getJSONEmployees');
Route::get('get-employees-report/{reg_status}/{wStation}/{emp_type}/{requestBy}','EmployeeReportController@getJSONEmployeesByFilter');


//Role routes
Route::resource('roles', 'RoleAndPermissionController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-roles','RoleAndPermissionController@getJSonRolesData');

//Role Professions
Route::resource('professions', 'ProfessionController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-professions','ProfessionController@getJSonProfessionsData');
//Role routes
Route::resource('profession-registrations', 'ProfessionRegistrationController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-professionRegstrations','ProfessionRegistrationController@getJSonProfessionRegistrationsData');

//Role routes
Route::resource('regions', 'RegionController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-regions','RegionController@getJSonRegionsData');
