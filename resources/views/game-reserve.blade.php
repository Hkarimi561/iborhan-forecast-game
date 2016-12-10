@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>خرید بلیط</h3>
        </div>
        <div class="panel-body">
            <div class="table col-md-12" style="border:2px solid #F3F4F5; margin-bottom: 5px" id="table">

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $("#fakeLoader").fakeLoader({
            timeToHide: 1200, //Time in milliseconds for fakeLoader disappear
            zIndex: "999",//Default zIndex
            spinner: "spinner5",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor: "#1A5B5B" //Hex, RGB or RGBA colors
        });
    </script>



    <script>
        moment.loadPersian();
        moment.locale('fa',{
            weekdays : "یکشنبه_دوشنبه_سه شنبه_چهارشنبه_پنج شنبه_جمعه_شنبه".split("_"),
            weekdaysShort : "یکشنبه_دوشنبه_سه شنبه_چهارشنبه_پنج شنبه_جمعه_شنبه".split("_"),
        });
        $.ajax({
            type: "get",
            url: "/api/user/reserve/matches",
            success: function (data) {
                jQuery.each(data, function (key, value) {
                    $("#table").append(
                            '<div class="border">' +
                            '<div class="row">' +
                            '<div class="col-md-9" style="text-align: center;">' +
                            '<div class="col-md-4"><img width="90" src="http://www.footballeticket.ir/' + value['HostLogoPath'] + '" style="margin-top: 5px;margin-bottom: 5px"><p>'+value['HostName']+'</p></div>' +
                            '<div class="col-md-4" style="text-align: center; vertical-align: middle"><br><br><p>'+value['TournamentName']+'</p>-</div>' +
                            '<div class="col-md-4"><img width="90" src="http://www.footballeticket.ir/' + value['AwayLogoPath'] + '" style="margin-top: 5px;margin-bottom: 5px"><p>'+value['AwayName']+'</p></div>' +
                            '</div>' +
                            '<div class="col-md-3" style="background-color: #e0e1e2 ; text-align: right; vertical-align: middle">' +
                            '<br>' +
                            '<div class="row" style="margin-top: 5px ;margin-right: 5px"><br>'+value['StadiumName'] + ' '+ value['ComplexName']+ '</div>' +
                            '<div class="row" style="margin-right: 5px">زمان :' + moment(value['MatchDate']).format('HH:mm') + '</div>' +
                            '<div class="row" style="margin-bottom: 15px;margin-right: 5px">تاریخ :' + moment(value['MatchDate']).format('dddd jDD  jMMMM  jYYYY ') + '<br><br></div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row" >' +
                            '<div class="col-md-9" style="background-color: #D3D7D6">' +
                            '<div class="col-md-4" style=";text-align: center;"><a class="btn btn-danger" style="margin-top: 5px;margin-bottom: 5px" href="/user/matches/reserve?matchId='+value['MatchId']+'&teamId='+value['HostId']+'"><i class="fa fa-money" aria-hidden="true"></i>خرید بلیط </a></div>' +
                            '<div class="col-md-4" style=";text-align: center;"></div>' +
                            '<div class="col-md-4" style="text-align: center;"><a class="btn btn-danger" style="margin-top: 5px;margin-bottom: 5px" href="/user/matches/reserve?matchId='+value['MatchId']+'&teamId='+value['AwayId']+'"><i class="fa fa-money" aria-hidden="true"></i> خرید بلیط </a></div>' +
                            '</div>' +
                            '<div class="col-md-3" style="background-color: #D3D7D6;text-align: center"><a class="btn btn-primary" style="margin-top: 5px;margin-bottom: 5px"><i class="fa fa-file-text-o" aria-hidden="true"></i> جزئیات بازی </a></div>' +
                            '</div>' +
                            '</div>'
                    )
                })
            }
        });
    </script>
@endsection