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
                        <div class="panel-heading">
                            List of Employees
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" >
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
                                    @foreach($employees as $particular)                               
                                     <tr>
                                        <td>{{$particular['full_name']}}</td>
                                        <td>{{$particular['region']}}</td>
                                        <td>{{$particular['profession']}}</td>
                                        <td>{{$particular['education']}}</td>
                                        <td>{{$particular['registration_status']}}</td>
                                        <td><?php echo $particular['action'];?></td>
                                     </tr>
                                    
                                    @endforeach
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
        var url = window.location.pathname
       
       
    }); 
    </script>

@endsection