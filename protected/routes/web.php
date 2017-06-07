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

//Home routes
Route::get('/','HomeController@index');
Route::get('home','HomeController@index');


//Employee routes
Route::resource('employees', 'EmployeeController',['only' => [
    'index', 'show','create'
]]);

//Role routes
Route::resource('roles', 'RoleController',['only' => [
    'index', 'show','create'
]]);

//Role routes
Route::resource('particulars', 'ParticularController',['only' => [
    'index', 'show','create'
]]);

//Role routes
Route::resource('regions', 'RegionController',['only' => [
    'index', 'show','create'
]]);