<?php

namespace App\Http\Controllers;

use App\EmployeeParticular;
use Illuminate\Http\Request;

class EmployeeParticularController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeParticular  $employeeParticular
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeParticular $employeeParticular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeParticular  $employeeParticular
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeParticular $employeeParticular)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeParticular  $employeeParticular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeParticular $employeeParticular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeParticular  $employeeParticular
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeParticular $employeeParticular)
    {
        //
    }
}
