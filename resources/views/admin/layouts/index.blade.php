<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title>Admin</title>
    <base href="{{asset('')}}">  
    <link rel="icon" type="image/png" href="{{ asset('backEnd/login/images/icons/favicon.ico') }}"/>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backEnd/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('backEnd/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('backEnd/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('backEnd/dist/css/customLHP.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('backEnd/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ asset('backEnd/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('backEnd/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    @yield('link')
</head>

<body>

    <div id="wrapper">

        @include('admin.layouts.header')

        @yield('content')

    </div>
        @yield('modal')
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('backEnd/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('backEnd/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('backEnd/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>
    
    <!-- Ckeditor JavaScript -->
    <script type="text/javascript" language="javascript" src="{{ asset('backEnd/ckeditor/ckeditor.js') }}" ></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('backEnd/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('backEnd/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backEnd/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable();
        });
    </script>

    @yield('script')
</body>

</html>
