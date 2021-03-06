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
                    <h2 class="page-header">All Professions</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List of Professions
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="professionDataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Profession Name</th>
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
@endsection
@section('footer')
     @include('layout.footer')
@endsection
@section('scripts')
 <script>
     $(document).ready(function(){


     //Load all regions and number employees available in.
        $('#professionDataTable').DataTable({
            responsive: true,
            ajax : '{{url("get-professions")}}', //this url load JSON region details to reduce loading time
        });


     });


 </script>
@endsection
