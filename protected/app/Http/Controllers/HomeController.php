<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class HomeController extends Controller{
    
    
    public function __construct()
    {
       // $this->middleware('auth');
      //  $this->import_errors="";
    }
    public function index()
    {
        return view('index');
    }
    
}