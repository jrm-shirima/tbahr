@extends('layout.master')
@section('page-title')
    {{"All Employees"}}
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
                    <h1 class="page-header">All Employees</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Retrieve employees by :</h4>
                                </div>
                            </div>
                             <div class="row">
                                 <div class="col-lg-11 col-md-offset-1 form-inline">
                                      <div class="form-group">
                                        <label for="registration_status">Registration Status</label>
                                        <select class="form-control" name="registration_status" id="registration_status">
                                            <option value="registration-status-all">All</option>
                                            @foreach($professionRegs as $profReg)
                                                <option value="{{$profReg->id}}">{{$profReg->profession_reg_name}}</option>
                                             @endforeach
                                            </select>
                                      </div>
                                      <div class="form-group">
                                            <label for="region">Region</label>
                                            <select class="form-control" name="region" id="region">
                                                 <option value="region-all">All</option>
                                              @foreach($regions as $region)
                                                <option value="{{$region->id}}">{{$region->region}}</option>
                                             @endforeach
                                            </select>
                                      </div>
                                     <div class="form-group">
                                            <label for="employeeType">Employee Type</label>
                                            <select class="form-control" name="employeeType" id="employeeType">
                                                <option value="employee-all">All</option>
                                              <option value="Permanent" >Permanent</option>
                                              <option value="Temporary">Temporary</option>
                                              <option value="Internship">Internship</option>                                              
                                            </select>
                                     </div>
                                 </div>
                            </div>                             
                        </div>
                      </div>
                    </div>
                </div>               
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                List of Employees
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="employeesReportDataTable">
                                
                                </table>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
</div>
@endsection
@section('header')
     @include('layout.footer')
@endsection
@section('scripts')
     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    jQuery(document).ready(function() {
    
        var registration_status = $('#registration_status');
        var region              = $('#region');
        var employeeType        = $('#employeeType');
        var base_url  = '{{url("get-employees-report")}}';
        
        loadData(base_url);
        
        
        region.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
             var requestBy  = "region";
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type+'/'+requestBy;
            loadData(url);
            
        });
        registration_status.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
            var requestBy  = "registration_status";
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type+'/'+requestBy;
            loadData(url);
            
        });
        employeeType.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
            var requestBy  = "employment_type";
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type+'/'+requestBy;
            loadData(url);
            
        });
        
    function loadData(url){
        console.log(url);
        
      $.get(url, function(data, status){
        var dataSet=   JSON.parse(data);
        processReceivedData(dataSet);
       
      });
        
    } 
        
  function processReceivedData(dataSet){
       console.log(dataSet);
  $('#employeesReportDataTable').DataTable( {
          "destroy": true,
          data: dataSet,
          columns: [
              { title: "Full Name" },
              { title: "Phone" },
              { title: "Education" },
              { title: "Profession" },
              { title: "Emp. Type" },
              { title: "Reg. Status" },
              { title: "Region" },
              { title: "Ret. Date" }            
              
          ]
      } );
             
       }  
      
    });
    
    </script>

@endsection
