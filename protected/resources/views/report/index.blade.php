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
                                              @foreach($professions as $profession)
                                                <option value="{{$profession->id}}">{{$profession->profession_name}}</option>
                                             @endforeach
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
        
        region.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
            
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type
            loadData(url);
            
        });
        registration_status.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
            
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type
            loadData(url);
            
        });
        employeeType.on('change', function(){
            
            var reg_status = registration_status.val();
            var emp_type   = employeeType.val();
            var wStation   = region.val();
            
            var url  = base_url+'/'+reg_status+'/'+wStation+'/'+emp_type
            loadData(url);
            
        });
        
    function loadData(url){
        console.log(url);
        
      $.get(url, function(data, status){
        console.log(data);
       
      });
        
    } 
        
        
        
        var dataSet = [
                    [ "Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800" ],
                    [ "Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750" ],
                    [ "Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000" ],
                    [ "Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060" ],
                    [ "Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700" ],
                    [ "Brielle Williamson", "Integration Specialist", "New York", "4804", "2012/12/02", "$372,000" ],
                    [ "Herrod Chandler", "Sales Assistant", "San Francisco", "9608", "2012/08/06", "$137,500" ],
                    [ "Rhona Davidson", "Integration Specialist", "Tokyo", "6200", "2010/10/14", "$327,900" ],
                    [ "Colleen Hurst", "Javascript Developer", "San Francisco", "2360", "2009/09/15", "$205,500" ],
                    [ "Sonya Frost", "Software Engineer", "Edinburgh", "1667", "2008/12/13", "$103,600" ],
                    [ "Jena Gaines", "Office Manager", "London", "3814", "2008/12/19", "$90,560" ],
                    [ "Quinn Flynn", "Support Lead", "Edinburgh", "9497", "2013/03/03", "$342,000" ],
                    [ "Charde Marshall", "Regional Director", "San Francisco", "6741", "2008/10/16", "$470,600" ],
                    [ "Haley Kennedy", "Senior Marketing Designer", "London", "3597", "2012/12/18", "$313,500" ],
                    [ "Tatyana Fitzpatrick", "Regional Director", "London", "1965", "2010/03/17", "$385,750" ],
                    [ "Michael Silva", "Marketing Designer", "London", "1581", "2012/11/27", "$198,500" ],
                    [ "Paul Byrd", "Chief Financial Officer (CFO)", "New York", "3059", "2010/06/09", "$725,000" ],
                    [ "Gloria Little", "Systems Administrator", "New York", "1721", "2009/04/10", "$237,500" ],
                    [ "Bradley Greer", "Software Engineer", "London", "2558", "2012/10/13", "$132,000" ],
                    [ "Dai Rios", "Personnel Lead", "Edinburgh", "2290", "2012/09/26", "$217,500" ],
                    [ "Jenette Caldwell", "Development Lead", "New York", "1937", "2011/09/03", "$345,000" ],
                    [ "Yuri Berry", "Chief Marketing Officer (CMO)", "New York", "6154", "2009/06/25", "$675,000" ],
                    [ "Caesar Vance", "Pre-Sales Support", "New York", "8330", "2011/12/12", "$106,450" ],
                    [ "Doris Wilder", "Sales Assistant", "Sidney", "3023", "2010/09/20", "$85,600" ],
                    [ "Angelica Ramos", "Chief Executive Officer (CEO)", "London", "5797", "2009/10/09", "$1,200,000" ],
                    [ "Gavin Joyce", "Developer", "Edinburgh", "8822", "2010/12/22", "$92,575" ],
                    [ "Jennifer Chang", "Regional Director", "Singapore", "9239", "2010/11/14", "$357,650" ],
                    [ "Brenden Wagner", "Software Engineer", "San Francisco", "1314", "2011/06/07", "$206,850" ],
                    [ "Fiona Green", "Chief Operating Officer (COO)", "San Francisco", "2947", "2010/03/11", "$850,000" ],
                    [ "Shou Itou", "Regional Marketing", "Tokyo", "8899", "2011/08/14", "$163,000" ],
                    [ "Michelle House", "Integration Specialist", "Sidney", "2769", "2011/06/02", "$95,400" ],
                    [ "Suki Burks", "Developer", "London", "6832", "2009/10/22", "$114,500" ],
                    [ "Prescott Bartlett", "Technical Author", "London", "3606", "2011/05/07", "$145,000" ],
                    [ "Gavin Cortez", "Team Leader", "San Francisco", "2860", "2008/10/26", "$235,500" ],
                    [ "Martena Mccray", "Post-Sales support", "Edinburgh", "8240", "2011/03/09", "$324,050" ],
                    [ "Unity Butler", "Marketing Designer", "San Francisco", "5384", "2009/12/09", "$85,675" ]
                ];
  $('#employeesReportDataTable').DataTable( {
          data: dataSet,
          columns: [
              { title: "Name" },
              { title: "Position" },
              { title: "Office" },
              { title: "Extn." },
              { title: "Start date" },
              { title: "Salary" }
          ]
      } );
    });
    </script>

@endsection
