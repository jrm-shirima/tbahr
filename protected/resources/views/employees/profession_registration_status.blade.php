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
                    <h1 class="page-header">All {{$professionReg->profession_reg_name}} Employees</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of {{$professionReg->profession_reg_name}} Employees
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <table width="100%" class="table table-striped table-bordered table-hover" id="employeesByProfessionDataTable">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Region</th>
                                        <th>Profession</th>
                                        <th>Education</th>
                                        <th>Registration Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Region</th>
                                        <th>Profession</th>
                                        <th>Education</th>
                                        <th>Registration Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
    $(document).ready(function() {
       var currentPathname = window.location.pathname;
       var urlPattern = currentPathname.split('/');
       var i,id = 0; 
        for (i = 0; i < urlPattern.length; i++) {
               if(i == (urlPattern.length -1)){
                  id = urlPattern[i]
                }
            }        
        console.log(id);
        $('#employeesByProfessionDataTable').DataTable({
            responsive: true,
            select:true,
            ajax : '{{url("get-employees/registration-status/")}}/'+id+'', //this url load JSON Client details to reduce loading time
        });
    
    }); 
    </script>

@endsection