@extends('layout.master')
@section('page-title')
    {{"Add Particulars"}}
@endsection
@section('header')
     @include('layout.header')
@endsection
@section('main-right-navigation')
     @include('layout.main-right-navigation')
@endsection
@section('main-home')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add Roles</h2>
                </div>                
            </div>
             <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="first_name">Particular </label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                      </div>
                      <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input  type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                      </div>
                      <div class="form-group">
                        <label for="dob">Date of birth</label>
                        <input  type="text" class="form-control" id="dob" name="dob" placeholder="Enter date of birth">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div>
                     <fieldset class="form-group">
                            <legend>Gender</legend>
                            <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="female" >Female</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="other">Other</label> 
                    </fieldset>
               </div>                                  
          </div>                 
</div>
@endsection
@section('header')
     @include('layout.footer')
@endsection