@extends('layout.master')
@section('page-title')
    {{"Home"}}
@endsection
@section('header')
     @include('layout.header')
@endsection
@section('left-navigation')
     @include('layout.left-navigation')
@endsection
@section('top-navigation')
     @include('layout.top-navigation')
@endsection
@section('page-content')
    @if( Auth::user()->can('write','modify','fullcontrol'))
        <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
              <div class="col-lg-12">
                  <h1>Add New Employee</h1>
              </div>
              <!-- /.col-lg-12 -->
          </div>
        </div>
        <div class="panel-body">
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
                            <fieldset class="form-group">
                                   <legend>Gender</legend>
                                   <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
                                   <label class="radio-inline"><input type="radio" name="gender" value="female" >Female</label>
                           </fieldset>
                           <div class="form-group">
                               <label for="email">Email address</label>
                               <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                               <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                           </div>
                           <div class="form-group">
                               <label for="phone">Phone</label>
                               <input  type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                           </div>
                          <div class="form-group">
                               <label for="employment_type">Type of Employment</label>
                               <select class="form-control" id="employment_type" name="employment_type">
                                 <option value="Permanent" >Permanent</option>
                                 <option value="Temporary">Temporary</option>
                                 <option value="Internship">Internship</option>
                               </select>
                           </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                           <label for="marital_status">Marital Status</label>
                           <select class="form-control" id="marital_status" name="marital_status">
                             <option value="Single" >Single</option>
                             <option value="Married">Married</option>
                             <option value="Divorced">Divorced</option>
                             <option value="Widowed" >Widowed</option>
                           </select>
                         </div>
                         <div class="form-group">
                           <label for="education">Education</label>
                           <input type="text" class="form-control" id="education" name="education" placeholder="Enter Education">
                         </div>
                         <div class="form-group">
                           <label for="registration_status">Registration Status</label>
                           <select class="form-control" name="registration_status" id="registration_status">
                                 @foreach($professionRegs as $profReg)
                                   <option value="{{$profReg->id}}">{{$profReg->profession_reg_name}}</option>
                                @endforeach
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
                                   <option value="{{$region->id}}">{{$region->region}}</option>
                                @endforeach
                               </select>
                         </div>
                        <div class="form-group">
                               <label for="profession">Profession</label>
                               <select class="form-control" name="profession" id="profession">
                                 @foreach($professions as $profession)
                                   <option value="{{$profession->id}}">{{$profession->profession_name}}</option>
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
        </div>
        @else
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
               <div class="alert alert-info alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Sorry!</strong> You are trying to perform an action that you do not have permission of. <br> Please contact administrator for further instructions
                </div>
            </div>
        </div>
        @endif



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
