@extends('layout.master')
@section('page-title')
    {{"Regions"}}
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
                    <h2 class="page-header">All Regions</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-right" data-toggle="modal" data-target="#btn-add-region">Add Employee to Region</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Regions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="regionsDataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Region Name</th>
                                        <th>Number of Employees</th>                                        
                                        <th>Action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <!-- Modal -->
                <div class="modal fade" id="btn-add-region" tabindex="-1" role="dialog" aria-labelledby="btn-add-region" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="formAddEmployeeToRegion" action="{{url('employees/workstation')}}" method="POST">
                               {{ csrf_field() }}
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="btn-add-region">Add Employee to Region</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                     <div class="row">

                                          <div class="col-lg-8 col-lg-offset-2">
                                             <div class="form-group">
                                                <label for="marital_status">Select Region</label>
                                                <select class="form-control" id="marital_status" name="marital_status">
                                                  <option value="Single" >Singida</option>
                                                  <option value="Married">Mara</option>
                                                  <option value="Divorced">Kigoma</option>
                                                  <option value="Widowed" >Arusha</option>
                                                  <option value="Common-law marriage" >Dar-es-Salaam</option>
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                    <label for="last_name">Search or Type in Employee name</label>
                                                    <input id="searchEmployeeToAdd"  type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                                               </div>                                   
                                         </div> 
                                  </div>
                                  <div class="row" >
                                      <div class="col-lg-8 col-lg-offset-2"id="queryResult">
                                          
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-success" value="Submit"/>
                                  </div>
                                </div>
                        </form>
                  </div>
                </div>
            </div> 
</div>
@endsection
@section('footer')
     @include('layout.footer')
@endsection
@section('scripts')
 <script>
     $(document).ready(function(){
      
      var formObject = $("#formAddEmployeeToRegion");
      formObject.on('submit',function(){
          
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
                         console.log(data);
                        setTimeout(function() {
                            $("#output").html("");
                        }, 2000);
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
                            errorsHtml += '</ul></div>';
                            $('#output').html(errorsHtml);
                            
                        }else{
                            $('#output').html(jqXhr.message);
                        }
                    }
                });
    }
     
     //Load all regions and number employees available in.
        $('#regionsDataTable').DataTable({
            responsive: true,
            ajax : '{{url("get-regions")}}', //this url load JSON region details to reduce loading time
        });
  
     
     });
     
     
      
        //Load all regions and number employees available in.
                
         
      $('#searchEmployeeToAdd').on('keyup', function(){
             var employeeToAdd  = $('#searchEmployeeToAdd'); 
             var postData       = employeeToAdd.val();             
          getMatchingEmployee(postData);
            
         });
    function getMatchingEmployee(postData, token){
         var queryResult = $('#queryResult');        
        
         $.ajax( "{{url('regions/load-data-to-match')}}",
                  function(data){
                         
                     var result    = '<div class="form-group"><label for="sel1">Select list:</label><select class="form-control" id="sel1">';
                         result    += '<option value='+data['id']+'>'+ data['first_name']+''+ data['last_name'] + '</option>';
                         result    += '</select></div>';
                      
                         console.log(data);                        
                    });
        
        
     }
     
 </script>
@endsection
