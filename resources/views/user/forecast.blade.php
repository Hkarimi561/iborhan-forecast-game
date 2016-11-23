@extends('master')
@section('public_forecast', 'active')

@section('main_content')
    @foreach($games as $game)
        <form id="forecast" method="post" action="{{ route('forecast_submit' ,['id' => $game->id]) }}">
            {{ csrf_field() }}
            <div style="margin-top: 50px;">
                <table class="col-xs-12 text-center "
                       style="height: 200px; background-color: black; border-radius: 20px; color: white; margin-bottom: 30px ">
                    <tr>
                        <td></td>
                        <td>{{$game['game_time']}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{$game['stadium']['name']}}</td>
                    </tr>
                    <tr>
                        {{ csrf_field() }}
                        <td width="20%"><img class="img-medium img-circle" src="{{$game['home_team']['avatar']}}"></td>

                        <td width="20%">
                            <span style="float: right">
                                <a class="fa fa-angle-up fa-2x upDown" onclick="increaseButtonH()" style="display: block;"></a>
                            <input class="inputForm" id="home_point" name="home_point" type="number" size="2"
                                   maxlength="5" onkeyup="this.value = minmax(this.value, 0, 10)"/>
                                <a class="fa fa-angle-down fa-2x upDown" onclick="decreaseButtonH()" style="display: block;"></a>
                            </span>
                            <span class="h1" style="position: relative; top: 40px;">:</span>
                            <span style="float:left;">
                                 <a class="fa fa-angle-up fa-2x upDown" onclick="increaseButtonA()" style="display: block;"></a>
                            <input class="inputForm " id="away_point" type="number" name="away_point" size="2"
                                   maxlength="5" onkeyup="this.value = minmax(this.value, 0, 100)"/>
                                 <a class="fa fa-angle-down fa-2x upDown" onclick="decreaseButtonA()" style="display: block;"></a>
                            </span>
                            <div style="margin-topg: 20px">
                            </div>
                        </td>
                        <td width="20%"><img class="img-medium img-circle" src="{{$game['away_team']['avatar']}}"></td>
                    </tr>
                    <tr>
                        <td width="20%">{{$game['home_team']['name']}}</td>
                        <td></td>
                        <td width="20%">{{$game['away_team']['name']}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input class="btn btn-danger btn-block" type="submit" id="submit" value="ثبت پیش بینی"
                                   name="upload">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    @endforeach

@endsection
@section('script')
    <script>
        $("#fakeLoader").fakeLoader({
            timeToHide: 1200, //Time in milliseconds for fakeLoader disappear
            zIndex: "999",//Default zIndex
            spinner: "spinner5",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor: "#1A5B5B" //Hex, RGB or RGBA colors
        });
        var i = 0;
        function increaseButtonH() {
            document.getElementById('home_point').value = ++i;
        }
        function decreaseButtonH() {
            document.getElementById('home_point').value = --i;
        }
        var j = 0;
        function increaseButtonA() {
            document.getElementById('away_point').value = ++j;
        }
        function decreaseButtonA() {
            document.getElementById('away_point').value = --j;
        }




    </script>
@endsection
