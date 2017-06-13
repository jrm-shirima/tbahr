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
                    <h2 class="page-header">Add New Employee</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <form id="formEmployee" action="{{url('employees')}}" method="POST">
                  {{ csrf_field() }}
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
                           <div class="form-group"> <!-- Date input -->
                            <label class="control-label" for="date">Date of birth</label>
                            <input class="form-control" id="date" name="dob" placeholder="YYYY-MM-DD" type="text"/>
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
                            <input type="text" class="form-control" id="education" name="education" placeholder="Enter Education">
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
                          <div class="form-group"> <!-- Date input -->
                            <label class="control-label" for="date">Employment Date</label>
                            <input class="form-control" id="employment_date" name="employment_date" placeholder="YYYY-MM-DD" type="text"/>
                          </div>
                          <div class="form-group">
                            <label for="certifications">Region</label>
                            <select class="form-control" name="region" id="region">
                              @foreach($regions as $region)
                                <option value="{{$region->region}}">{{$region->region}}</option>
                             @endforeach

                            </select>
                       </div>                          
                </div>
            
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8 pull-left" id="output">
                 <span class="load-spinner"></span>
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
@section('header')
     @include('layout.footer')
@endsection
@section('scripts')
 <script>
     $(document).ready(function(){
         
       var dob_input=$('input[name="dob"]'); //our date input has the name "date"
       var employmentDate_input=$('input[name="employment_date"]'); //our date input has the name "date"
     
       var options={
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
      };
      dob_input.datepicker(options);      
      employmentDate_input.datepicker(options);
      
      var formObject = $("#formEmployee");
      formObject.on('submit',function(){
             $('.load-spinner').css('display','block');
              var postData = formObject.serializeArray();
              var formURL  = formObject.attr("action");
            
                submitData(postData, formURL);         
          
          return false;
          });         
       
      
     
    function submitData(postData, formURL){
        
        
        $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : postData,
                    success: function(data){
                       if(data.success == true){
                        $('.load-spinner').css('display','none');
                         console.log(data);
                         var rsMsg = '<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                            rsMsg  +='<strong>Success!</strong> You\'ve successifully, added new employee, You can <a href="{{url("employees")}}" class="alert-link">view here</a>.</div>';
                         $("#output").html(rsMsg);
                         $("#formEmployee").closest('form').find("input[type=text], textarea").val("");
                        }
                         
                        
                    },
                    error: function(jqXhr,status, response) {
                        console.log(jqXhr);
                        if( jqXhr.status === 401 ) {
                           // location.replace('{{url('login')}}');
                        }
                        if( jqXhr.status === 400 ){
                            
                            var errors = jqXhr.responseJSON.errors;
                            var errorsHtml = '<div class="alert alert-danger"><p class="text-uppercase text-bold">There are errors kindly check</p><ul>';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                            });
                            errorsHtml += '</ul></di>';
                            $('#output').html(errorsHtml);
                            
                        }else{
                            $('#output').html(jqXhr.message);
                        }
                    }
                });
    }
     
     
     
     });
      
      
     
 </script>
@endsection
