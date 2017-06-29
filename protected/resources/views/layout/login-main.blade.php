<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TBA | @yield('page-title')</title>

    <!-- Global stylesheets -->

    <!-- Bootstrap -->
    <link href="{{asset("assets/vendors/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset("assets/vendors/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset("assets/vendors/nprogress/nprogress.css")}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset("assets/vendors/iCheck/skins/flat/green.css")}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset("assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset("assets/vendors/jqvmap/dist/jqvmap.min.css")}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset("assets/vendors/bootstrap-daterangepicker/daterangepicker.css")}}" rel="stylesheet">
        <!-- Datatable plugin -->
    <!-- Global stylesheets -->
   <link href="{{asset("protected/assets/vendor/datatables-plugins/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css">
   <link href="{{asset("protected/assets/vendor/datatables-responsive/dataTables.responsive.css")}}" rel="stylesheet" type="text/css">
   <link href="{{asset("protected/assets/vendor/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">
   <link href="{{asset("protected/assets/css/tbahr.min.css")}}" rel="stylesheet" type="text/css">
   <link href="{{asset("protected/assets/vendor/sd-admin/dist/css/sb-admin-2.css")}}" rel="stylesheet" type="text/css">
   <!-- Custom Theme Style -->
   <link href="{{asset("assets/build/css/custom.min.css")}}" rel="stylesheet">
   <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
     <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
     <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

    <!-- /global stylesheets -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


    <!--Tbahr Css-->
    <link href="{{asset("protected/assets/css/tbahr.min.css")}}" rel="stylesheet" type="text/css">
    <style>
     .page-header {
        padding-bottom: 9px;
        margin: 0px 0 0px !important;
        border-bottom: 1px solid #eee;
    }
    </style>

</head>

<body class="nav-md">
     <div class="container body">
          <div class="main_container">
                   @yield('page-content')
          </div>
    </div>


<!-- Core JS files -->

    <!-- jQuery -->
    <script src="{{asset("assets/vendors/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset("assets/vendors/bootstrap/dist/js/bootstrap.min.js")}}"></script>
    <!-- JQuery DataTable-->
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables/js/jquery.dataTables.min.js")}}"></script>
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js")}}"></script>
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables-responsive/dataTables.responsive.js")}}"></script>
    <!-- FastClick -->
    <script src="{{asset("assets/vendors/fastclick/lib/fastclick.js")}}"></script>
    <!-- NProgress -->
    <script src="{{asset("assets/vendors/nprogress/nprogress.js")}}"></script>
    <!-- Chart.js -->
    <script src="{{asset("assets/vendors/Chart.js/dist/Chart.min.js")}}"></script>
    <!-- gauge.js -->
    <script src="{{asset("assets/vendors/gauge.js/dist/gauge.min.js")}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset("assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
    <!-- iCheck -->
    <script src="{{asset("assets/vendors/iCheck/icheck.min.js")}}"></script>
    <!-- Skycons -->
    <script src="{{asset("assets/vendors/skycons/skycons.js")}}"></script>
    <!-- Flot -->
    <script src="{{asset("assets/vendors/Flot/jquery.flot.js")}}"></script>
    <script src="{{asset("assets/vendors/Flot/jquery.flot.pie.js")}}"></script>
    <script src="{{asset("assets/vendors/Flot/jquery.flot.time.js")}}"></script>
    <script src="{{asset("assets/vendors/Flot/jquery.flot.stack.js")}}"></script>
    <script src="{{asset("assets/vendors/Flot/jquery.flot.resize.js")}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset("assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js")}}"></script>
    <script src="{{asset("assets/vendors/flot-spline/js/jquery.flot.spline.min.js")}}"></script>
    <script src="{{asset("assets/vendors/flot.curvedlines/curvedLines.js")}}"></script>
    <!-- DateJS -->
    <script src="{{asset("assets/vendors/DateJS/build/date.js")}}"></script>
    <!-- JQVMap -->
    <script src="{{asset("assets/vendors/jqvmap/dist/jquery.vmap.js")}}"></script>
    <script src="{{asset("assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js")}}"></script>
    <script src="{{asset("assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js")}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset("assets/vendors/moment/min/moment.min.js")}}"></script>
    <script src="{{asset("assets/vendors/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("protected/assets/vendor/datatables/js/datatables.material.min.js")}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <!-- /core JS files -->

    <!-- Custom Theme Scripts -->
    <script src="{{asset("assets/build/js/custom.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/js/tbahr.min.js")}}"></script>


    <!-- /core JS files -->
     @yield('scripts')
</body>
</html>
