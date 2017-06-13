@extends('layout.master')
@section('page-title')
    {{"Roles"}}
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
                <h1 class="page-header">Roles</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of Roles
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="rolesDataTable">
                            <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Role Name</th>
                                        <th>Number of Admins</th>                                        
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
    </div>
@endsection
@section('footer')
     @include('layout.footer')
@endsection
@section('scripts')
     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#rolesDataTable').DataTable({
            responsive: true,
            ajax : '{{url("get-roles")}}', //this url load JSON Client details to reduce loading time
        });
    }); 
    </script>

@endsection