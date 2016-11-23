@extends('master')

@section('main_content')
    <form id="forecast" method="post" action="{{ route('answer_submit',['game_id'=>$game[0]->id]) }}">
        {{ csrf_field() }}
    <div style="margin-top: 50px;">
        <table class="col-xs-12 text-center" style="height: 200px ">
            <tr>
                <td><img class="img-medium" src="{{$game[0]['home_team']['avatar']}}"></td>
                <td>{{$game[0]['home_team']['name']}}</td>
                <td>
                    <div>{{$game[0]['game_time']}}</div>
                    <div style="top: -50px;">{{$game[0]['stadium']['name']}}</div>
                    <br>
                    <input class="inputForm" name="home_point" type="text" size="2"> - <input name="away_point" class="inputForm " type="text" size="2">
                </td>
                <td>{{$game[0]['away_team']['name']}}</td>
                <td><img class="img-medium" src="{{$game[0]['away_team']['avatar']}}"></td>
            </tr>
        </table>
    </div>
    <div style="padding-top: 250px" class="rtl">

        @foreach($questions as $question)

            @if($question['type']=='text')
                <input type="text" name="answer[]">

            @elseif($question['type']=='checkbox')
            @endif
            <label>{{$question['question']}}</label><br>
        @endforeach
    </div>
        <div class="rtl">
        <input class="btn btn-lg btn-primary rtl" type="submit" id="submit" value="ثبت" name="upload">
        </div>
    </form>

@endsection
