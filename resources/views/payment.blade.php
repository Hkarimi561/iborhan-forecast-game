@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')
    <form action="http://89.165.5.100/StartPayment.aspx" method="post">
        <label for="">پرداخت مبلغ برای بازی {{$data['MatchId']}}</label>
        <input type="hidden" value="{{$data['UserName']}}" name="username">
        <input type="hidden" value="{{$data['Password']}}" name="password">
        <input type="hidden" value="{{$data['MatchId']}}" name="matchid">
        <button type="submit" class="btn btn-primary">ارسال به صفحه پرداخت</button>
    </form>
@endsection