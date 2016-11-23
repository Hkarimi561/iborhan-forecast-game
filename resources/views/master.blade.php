<!doctype html>
<html lang="en">
<head>
    <base href="http://forecast.dev">
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>iBorhan Forecast</title>
    <link href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bower_components/fakeLoader/fakeLoader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bower_components/ideal-image-slider/ideal-image-slider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bower_components/ideal-image-slider/themes/default/default.css')}}">
    <link href="{{asset('assets/bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bower_components/select2/dist/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bower_components/clockpicker/dist/bootstrap-clockpicker.css')}}">
    <link href="{{asset('assets/bower_components/datatables/media/css/jquery.dataTables.css')}}" rel="stylesheet">


    {{--start script--}}
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.js')}}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/bower_components/jquery.soap/jquery.soap.js')}}"></script>

    <script src="{{asset('assets/bower_components/fakeLoader/fakeLoader.js')}}"></script>
    <script src="{{asset('assets/bower_components/select2/dist/js/select2.full.js')}}"></script>
    <script src="{{asset('assets/bower_components/jquery-ui/jquery-ui.js')}}"></script>

    <script src="{{asset('assets/bower_components/datatables/media/js/jquery.dataTables.js')}}"></script>

    <script src="{{asset('assets/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/bower_components/moment-jalaali/build/moment-jalaali.js')}}"></script>

    <script src="{{asset('assets/bower_components/ideal-image-slider/ideal-image-slider.js')}}"></script>
    <script src="{{asset('assets/bower_components/clockpicker/dist/bootstrap-clockpicker.js')}}"></script>

    {{--<script src="{{asset('assets/bower_components/chart.js/src/chart.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.bundle.min.js"></script>--}}
{{--    <script src="{{asset('assets/bower_components/chart.js/src/charts/Chart.Doughnut.js')}}"></script>--}}


    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

</head>
<body>
<div id="fakeLoader"></div>
<div class="container" style="padding-top: 70px">
    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            @include('extends.topbar')
        </div>
    </nav>

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas rtl" id="sidebar">
            <div class="list-group">
                @if(auth()->check())
                    {{--<a href="{{route('make_team')}}" class="list-group-item">ایجاد تیم</a>--}}
                    {{--<a href="{{route('make_game')}}" class="list-group-item">ایجاد بازی</a>--}}
                    {{--<a href="{{route('stadium_create')}}" class="list-group-item">ایجاد استادیوم</a>--}}
                    {{--<a href="{{route('make_question')}}" class="list-group-item">ایجاد سوال</a>--}}
                    {{--<a href="{{route('make_player')}}" class="list-group-item">ایجاد بازیکن</a>--}}
                    {{--<a href="#" class="list-group-item">Link</a>--}}
                    <a  href="{{route('forecast')}}" class="list-group-item @yield('public_forecast')">نظر سنجی</a>
                    <a href={{route('my_forecast', ['id'=>auth()->user()->id])}} class="list-group-item @yield('public_myforecast')" >مشاهده پیش بینی های من</a>
                    {{--<a href="#" class="list-group-item">Link</a>--}}
                    @yield('menu')
                @else
                    <p>برای دیدن منو لطفا وارد شوید</p>
                @endif
            </div>
        </div><!--/.sidebar-offcanvas-->
        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>

            @yield('top_content')

            <div class="row">
                @yield('main_content')
            </div>
        </div>
    </div>


    </div><!--/.container-->
    <hr>
    <footer dir="ltr">
        <p>Copyright(c) 2016 Parax team</p>

    </footer>


    @yield('script')
</body>
</html>