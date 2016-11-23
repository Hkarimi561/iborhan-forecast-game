@extends('master')
@section('public_home', 'active')
@section('top_content')
    @if(auth()->check())
        <div class="panel panel-default">
            <div class="panel-heading"><h3 style="display: inline;">اطلاعات شما</h3><p style="display: inline;float: left;" id="score"></p></div>
            <div class="panel-body">
                <table class="table table-striped col-md-4">
                    <thead>
                    <tr>
                        <th>اطلاعات کاربری شما</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>نام :</td>
                        <td>{{auth()->user()->first_name}}</td>
                    </tr>
                    <tr>
                        <td>نام خانوادگی :</td>
                        <td>{{auth()->user()->last_name}}</td>
                    </tr>
                    <tr>
                        <td>نام نمایشی :</td>
                        <td>{{auth()->user()->display_name}}</td>
                    </tr>
                    <tr>
                        <td>کد ملی :</td>
                        <td>{{auth()->user()->national_code}}</td>
                    </tr>
                    <tr>
                        <td>شماره همراه :</td>
                        <td>{{auth()->user()->cell_phone}}</td>
                    </tr>
                    <tr>
                        <td>تلفن ثابت :</td>
                        <td>{{auth()->user()->phone}}</td>
                    </tr>
                    </tbody>
                </table>
                {{--
                <div class="col-md-3 horizontal-t-line"
                     style="border-left: 1px solid darkslategray;border-right: 1px solid darkslategray; border-radius: 2px">
                    <div class="row horizontal-b-line"><h4>اطلاعات کاربری شما</h4></div>
                    <div class="row">
                        <div class="col-md-6 " style="border-left: 1px solid darkslategray;">
                            <div class="row horizontal-b-line">نام :</div>
                            <div class="row horizontal-b-line">نام خانوادگی :</div>
                            <div class="row horizontal-b-line">نام نمایشی :</div>
                            <div class="row horizontal-b-line">کد ملی :</div>
                            <div class="row horizontal-b-line">شماره همراه :</div>
                            <div class="row horizontal-b-line">تلفن ثابت :</div>
                        </div>
                        <div class="col-md-6">
                            <div class="row horizontal-b-line">{{auth()->user()->first_name}}</div>
                            <div class="row horizontal-b-line">{{auth()->user()->last_name}}</div>
                            <div class="row horizontal-b-line">{{auth()->user()->display_name}}</div>
                            <div class="row horizontal-b-line">{{auth()->user()->national_code}}</div>
                            <div class="row horizontal-b-line">{{auth()->user()->cell_phone}}</div>
                            <div class="row horizontal-b-line">{{auth()->user()->phone}}</div>
                        </div>
                    </div>
                </div>
--}}
                <div class="col-md-8">
                    <div class="row">

                        <canvas id="myChart" class="col-md-6" style="margin-top: 10px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="jumbotron img-circle">
            <div id="slider">
                <img src="{{asset('images/2012_07_24_RSEV_Sports_Soccer2.jpg')}}" alt="Minimum required attributes">
                <img data-src="{{asset('images/Artificial-Turf-for-Sports1.jpg')}}" src=""
                     alt="Use data-src for on-demand loading">
                <img data-src="{{asset('images/sstbTurf2.jpg')}}" data-src-2x="img/3@2x.jpg" src=""
                     alt="Use data-src-2x for HiDPI devices">
            </div>
        </div>
    @endif
@endsection
@section('menu')



@endsection
@section('main_content')

    <div class="col-xs-12 chalkboard" id="center_write" style="font-family: farsiFont,serif">
        <div class="col-xs-12 board-gradient"
        >
            <table class="table">
                <thead style="text-align: center">
                <tr>
                    <th style="text-align: center">میزبان</th>
                    <th style="text-align: center">تاریخ</th>
                    <th style="text-align: center">زمان</th>
                    <th style="text-align: center">میهمان</th>
                    <th style="text-align: center">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($needed['game'] as $game)
                    <tr>

                        <td>{{$game->home_team->name}}</td>
                        <td id="game_time{{$game->id}}"></td>
                        <td id="game_date{{$game->id}}"></td>
                        <td>{{$game->away_team->name}}</td>
                        <td><a href="{{route('forecast_answer',['id'=>$game->id])}}" class="btn btn-danger">ثبت پیش
                                بینی</a></td>
                        <script>
                            //        moment().locale('fa').for;
                            moment.loadPersian();
                            var game_time = moment("{{$game['game_time']}}").locale('fa').format('HH:mm');
                            var game_date = moment("{{$game['game_time']}}").locale('fa').format('jDD jMMMM jYY');
                            document.getElementById("game_time{{$game->id}}").innerHTML = '<p>' + game_time + '</p>';
                            document.getElementById("game_date{{$game->id}}").innerHTML = '<p>' + game_date + '</p>';
                            //                            console.log(game_time);
                            //                            console.log(game_date);
                        </script>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <a href="{{route('forecast_answer')}}"></a>
        </div>

    </div>



@endsection
@section('script')
    <script>
        $("#fakeLoader").fakeLoader({
            timeToHide:1200, //Time in milliseconds for fakeLoader disappear
            zIndex:"999",//Default zIndex
            spinner:"spinner5",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor:"#1A5B5B" //Hex, RGB or RGBA colors
        });

    </script>
    @if(auth()->check())
        <script>
            $.ajax({
                type: "get",
                url: "http://forecast.dev/api/user/myForecastInfo?user_id={{$needed['user_id']}}",
                success: function (data) {
                    var true_data = data.true_forecast;
                    var forecast_data = data.forecast_count;
                    var point_data = data.my_point;
                    var false_answer = data.false_answer;
                    var mid_forecast = data.mid_forecast;
                    var score =data.score;
                    document.getElementById("score").innerHTML = 'امتیاز شما : '+score ;
                    var ctx = document.getElementById("myChart");
                    var myDoughnutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ["پاسخ های اشتباه شما","پاسخ های نیمه صحیح شما","پاسخ های صحیح شما"],
                            datasets: [{
                                data: [false_answer,mid_forecast,true_data],
                                backgroundColor: [

                                    "#3315B0",
                                    "#FFA500",
                                    "#1F8262"
                                ]
                            }]
                        },
                        options: {
                            legend: {
                                display: true,
                                boxWidth: 80,
                                position: 'top',
                                labels: {
                                    fontColor: '#000000'
                                }
                            }
                        }
                    });
//                      document.getElementById("myForecast").innerHTML=data.forecast_count
//                    document.getElementById("myTrueForecast").innerHTML=data.true_forecast
                }
            });
        </script>


    @endif
    <script>
        new IdealImageSlider.Slider('#slider');


    </script>
@endsection