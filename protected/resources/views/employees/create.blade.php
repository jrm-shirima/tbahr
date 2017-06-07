 @extends('layout.master')
@section('page-title')
    {{"Add Employee"}}
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
                    <h1 class="page-header">Add New Employee</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <form>
             <div class="row">
               
                    <div class="col-lg-6">
                         <div class="form-group">
                            <label for="first_name">First name</label>
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
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div>
                         <fieldset class="form-group">
                                <legend>Gender</legend>
                                <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="female" >Female</label>
                                <label class="radio-inline"><input type="radio" name="gender" value="other">Other</label> 
                        </fieldset>
                   </div>
                 <div class="col-lg-6">
                         <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <select class="form-control" id="marital_status" name="marital_status">
                              <option value="Single" >Single</option>
                              <option value="Married">Married</option>
                              <option value="Divorced">Divorced</option>
                              <option value="Widowed" >Widowed</option>
                              <option value="Common-law marriage" >Common-law marriage</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="education">Education</label>
                            <input type="password" class="form-control" id="education" name="education" placeholder="Enter Education">
                          </div>
                          <div class="form-group">
                            <label for="registration_status">Registration Status</label>
                            <select class="form-control" id="registration_status" name="registration_status">
                              <option value="Tanzania Board of Engineers" >Tanzania Board of Engineers</option>
                              <option value="2" >2</option>
                              <option value="3" >3</option>
                              <option value="4" >4</option>
                              <option value="5" >5</option>
                            </select>
                          </div>                          
                          <div class="form-group">
                            <label for="certifications">Certifications</label>
                            <select class="form-control" name="certifications" id="certifications">
                              <option value="CCNA">CCNA</option>
                              <option value="2" >2</option>
                              <option value="3" >3</option>
                              <option value="4" >4</option>
                              <option value="5" >5</option>
                            </select>
                       </div>                          
                </div>
            
        </div>
        <div class="row">
            <div class="col-lg-6">
                 <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">Submit</button>
            </div>
        </div>
       </form>
</div>
@endsection