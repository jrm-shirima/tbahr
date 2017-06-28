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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Employee Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2> {{$employee->first_name}} {{$employee->last_name}}'s {{"Details"}}</h2>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="25%">
                                            <table  class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th>Full Name</th>
                                                </tr>
                                                <tr>
                                                    <th>Email Address</th>
                                                </tr>
                                                <tr>
                                                    <th>Phone number</th>
                                                </tr>
                                                 <tr>
                                                    <th>Gender</th>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth</th>
                                                </tr>
                                                <tr>
                                                    <th>Marital Status</th>
                                                </tr>
                                                <tr>
                                                    <th>Education</th>
                                                </tr>
                                                <tr>
                                                    <th>Type of Employment</th>
                                                </tr>
                                                <tr>
                                                    <th>Employment Date</th>
                                                </tr>
                                                <tr>
                                                    <th>Work Station</th>
                                                </tr>
                                                <tr>
                                                    <th>Profession</th>
                                                </tr>
                                                <tr>
                                                    <th>Registration Status</th>
                                                </tr>
                                                <tr>
                                                    <th>Predictated Retirement Date</th>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table  class="table table-striped table-bordered table-hover" >
                                                <tr>
                                                    <td class="text-primary">{{$employee->first_name}} {{$employee->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employee->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employee->phone}}</td>
                                                </tr>
                                                 <tr>
                                                    <td class="text-primary">{{$employee->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{Helper::getFormattedDate($employee->dob)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employee->marital_status}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employeeParticular->education}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employeeParticular->employment_type}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{Helper::getFormattedDate($employeeParticular->employment_date)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employeeParticular->region}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employeeParticular->profession}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{$employeeParticular->registration_status}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-primary">{{Helper::getRetirementDate($employee->dob)}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
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
            <!-- /.row -->
@endsection
@section('footer')
     @include('layout.footer')
@endsection
@section('scripts')
     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

    });
    </script>

@endsection
