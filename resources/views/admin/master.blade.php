<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Forecast Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/datatables/media/css/jquery.dataTables.css')}}" rel="stylesheet">


    <link href="{{asset('assets/bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bower_components/select2/dist/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bower_components/clockpicker/dist/bootstrap-clockpicker.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/moment-datedroper/datedropper.css')}}">
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/admin/dashboard.css')}}" rel="stylesheet">

    {{--script start--}}
    <script src="{{asset('assets/bower_components/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('assets/bower_components/datatables/media/js/jquery.dataTables.js')}}"></script>


    <script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/bower_components/select2/dist/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/bower_components/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/bower_components/ideal-image-slider/ideal-image-slider.js')}}"></script>
    <script src="{{asset('assets/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/bower_components/moment-jalaali/build/moment-jalaali.js')}}"></script>
    <script src="{{asset('assets/bower_components/moment-jalaali/build/moment-jalaali.js')}}"></script>
    <script src="{{asset('assets/js/plugin/datetime-moment.js')}}"></script>


    <script src="{{asset('assets/bower_components/clockpicker/dist/bootstrap-clockpicker.js')}}"></script>
    <script src="{{asset('assets/moment-datedroper/moment-datedropper.js')}}"></script>
    <script src="{{asset('assets/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    {{--script end--}}


</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ادمین - پیش بینی</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right flip">

                <li><a href="/logout">خروج</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="@yield('home_nav_class')"><a href="/admin">داشبورد <span class="sr-only">(current)</span></a>
                </li>
                <li class="@yield('stadium_nav_class')"><a href="{{route('stadium')}}">استادیوم</a></li>
                <li class="@yield('player_nav_class')"><a href="{{route('player')}}">بازیکن ها</a></li>
                <li class="@yield('team_nav_class')"><a href="{{route('team')}}">تیم</a></li>
                <li class="@yield('question_nav_class')"><a href="{{route('question')}}">سوال</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="@yield('game_nav_class')"><a href="{{route('game')}}">بازی</a></li>
            </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('main_content')
        </div>

    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
@yield('script')
</body>
</html>