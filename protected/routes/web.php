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


//Employee routes
Route::resource('employees', 'EmployeeController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-employees','EmployeeController@getJSonEmployeesData');
Route::get('employees/profession/{id}','EmployeeController@getEmployeeByProfession');

//Employee Work Station routes
Route::post('employees/workstation','EmployeeWorkStationController@store');


//Role routes
Route::resource('roles', 'RoleController',['only' => [
    'index', 'show','create','store'
]]);
Route::get('get-roles','RoleController@getJSonRolesData');

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




