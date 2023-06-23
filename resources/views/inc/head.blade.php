<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{asset('AdminAssets/logo/logo.png')}}"/>
    <link href="{{asset('AdminAssets/assets/css/loader.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('AdminAssets/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('AdminAssets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('AdminAssets/assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('AdminAssets/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('AdminAssets/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .dataTables_wrapper select {
            padding: 8px 24px !important;
        }
    </style>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    @stack('css')

</head>
