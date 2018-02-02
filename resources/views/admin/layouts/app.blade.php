<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Bitnow Admin</title>

        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('admin/css/metisMenu.min.css')}}" rel="stylesheet">
        <link href="{{asset('admin/css/startmin.css')}}" rel="stylesheet">
        <link href="{{asset('admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.css')}}"> 

        <script src="{{asset('admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('admin/js/startmin.js')}}"></script>

        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    </head>
    <body>
        <div id="wrapper">
            @yield('content')
        </div>
        @stack('scripts')
    </body>
</html>
