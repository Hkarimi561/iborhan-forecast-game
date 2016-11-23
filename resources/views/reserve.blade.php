@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')

    @if($val!=1)
        <div class="panel panel-default">


            <form class="form-signin" id="football_e_ticket" method="post"
                  action="{{ route('football_e_ticket_validate') }}">
                {{csrf_field()}}
                <label for="name" class="sr-only">نام کاربری</label>
                <input type="text" name="user_name" id="name" class="form-control" placeholder="نام کاربری"
                       required="" autofocus="">
                <label for="inputPassword" class="sr-only">رمز عبور</label>
                <input type="password" id="inputPassword" name="password" class="form-control"
                       placeholder="رمز عبور" required="">
                <div class="checkbox">
                    <label>
                    </label>
                </div>
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif
                <button name="confirm" class="btn btn-lg btn-primary btn-block" type="submit">ثبت</button>
            </form>
        </div>
    @else
        <div class="panel panel-default">


            <form class="form-signin" id="football_e_ticket" method="post"
                  action="{{ route('football_e_ticket_number') }}">
                {{csrf_field()}}
                <label for="name" class="sr-only">کد ۱۶ رقمی عضویت</label>
                <input type="text" name="cardNumber" id="cardNumber" class="form-control" placeholder="کد ۱۶ رقمی عضویت"
                        autofocus="">
                <label for="name" class="sr-only">کد ملی</label>
                <input type="text" name="nationalCode" id="nationalCode" class="form-control" placeholder="کد ملی"
                        autofocus="">
                <input type="hidden" name="matchId" value="{{$needed['matchId']}}">
                <input type="hidden" name="sectionId" value="{{$needed['sectionId']}}">
                <input type="hidden" name="seatRow" value="{{$needed['seatRow']}}">
                <input type="hidden" name="seatNum" value="{{$needed['seatNum']}}">
                <input type="hidden" name="posId" value="{{$needed['posId']}}">
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif
                <button name="confirm" class="btn btn-lg btn-primary btn-block" type="submit">ثبت</button>
            </form>
        </div>

    @endif

@endsection
@section('script')
    <script>
    </script>



    <script>


    </script>
@endsection