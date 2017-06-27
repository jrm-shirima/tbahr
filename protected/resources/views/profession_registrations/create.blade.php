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
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add Profession Registration Name</h2>
                </div>                
            </div>
           <form id="professionRegistration" action="{{url('profession-registrations')}}" method="POST">
             {{ csrf_field() }}
             <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label for="prf_reg_name">Profession Name </label>
                        <input type="text" class="form-control" id="prf_reg_name" name="prf_reg_name" placeholder="Enter Profession Registration Name">
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
@section('footer')
     @include('layout.footer')
@endsection
@section('scripts')
    <script>
        
        $(document).ready(function(){
                var formObject = $("#professionRegistration");
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
                                    rsMsg  +='<strong>Success!</strong> You\'ve successifully, added new profession, You can <a href="{{url("profession-registrations")}}" class="alert-link">view here</a>.</div>';
                                 $("#output").html(rsMsg);
                                 $("#professionRegistration").closest('form').find("input[type=text], textarea").val("");
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
     </script>
@endsection