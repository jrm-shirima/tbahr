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
    <link href="{{asset("protected/assets/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/metisMenu/metisMenu.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/datatables-plugins/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/datatables-responsive/dataTables.responsive.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/sd-admin/dist/css/sb-admin-2.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/morrisjs/morris.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/vendor/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("protected/assets/css/tbahr.min.css")}}" rel="stylesheet" type="text/css">
    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!-- /global stylesheets -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
   

</head>

<body>
       <div id="wrapper">
         @yield('header')    
         @yield('main-right-navigation')
         @yield('main-home')
         @yield('footer')
       </div>
   

<!-- Core JS files -->
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/jquery/jquery.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/metisMenu/metisMenu.min.js")}}"></script>
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables/js/jquery.dataTables.min.js")}}"></script>
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js")}}"></script>
     <script type="text/javascript" src="{{asset("protected/assets/vendor/datatables-responsive/dataTables.responsive.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/raphael/raphael.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/morrisjs/morris.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/data/morris-data.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/datatables/js/datatables.min.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/vendor/sd-admin/dist/js/sb-admin-2.js")}}"></script>
    <script type="text/javascript"  src="{{asset("protected/assets/js/tbahr.min.js")}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <!-- /core JS files -->
     @yield('scripts')
</body>
</html>