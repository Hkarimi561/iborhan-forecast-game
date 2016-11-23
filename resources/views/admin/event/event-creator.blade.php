@extends('admin.master')
@section('main_content')
    <div class="test-message">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <form class="form-upload" id="question" action="{{ route('event_add') }}" method="post">
            {{ csrf_field() }}

            <div class="col-md-12">
                <label>نوع رویداد</label>
                <select class="js-example-basic-single col-md-12" name="type" dir="rtl">
                    <option value="goal">گل</option>
                    <option value="offside">افساید</option>
                    <option value="yellow-card">کارت زرد</option>
                    <option value="red-card">کارت قرمز</option>
                    <option value="foul">خطا</option>
                </select>
            </div>
            <div class="col-md-12">
                <label>انتخاب تیم : </label>
                <input type="radio" class="team_id" name="team_id"
                       value="{{$game['home_team']['id']}}"> {{$game['home_team']['name']}}
                <input type="radio" class="team_id" name="team_id"
                       value="{{$game['away_team']['id']}}"> {{$game['away_team']['name']}}
            </div>
            <div class="col-md-12">
                <label>انتخاب بازیکن</label>
                <select id="player" name="player_id" class="js-example-basic-single col-md-12" dir="rtl" disabled>
                    <option value="" selected="selected">انتخاب بازیکن</option>
                </select>
            </div>
            <div class="col-md-12" style="margin-top: 15px">
                <p>
                    <label for="spinner">زمان رویداد : </label>
                    <input id="spinner" type="text" value="1" name="event_time">
                </p>
            </div>
            <div class="col-md-12" style="margin-top: 15px">
                <input class="btn btn-lg btn-primary btn-block" type="submit" id="submit" value="اضافه کردن"
                       name="upload">
            </div>
            <input type="hidden" name="game_id" value="{{$game['id']}}">
        </form>
    </div>


@endsection
@section('script')
    <script>
        $("#spinner").TouchSpin({
            min: 0,
            max: 121,
            step: 1,
            prefix: "دقیقه",
            postfix: "<i class='fa fa-clock-o'></i>"
        });
    </script>
    <script type="text/javascript">


        $(".team_id").change(function () {
//            $("#player").prop("disabled", false);
            $("#player").prop("disabled", false).select2({
                ajax: {
                    url: "http://forecast.dev/api/team/player?id=" + parseInt($(".team_id:checked").val()),
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    }

                    ,
                    processResults: function (data) {
                        // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data
                        return {
                            results: data
                        };
                    }
                    ,
                    cache: true
                }
            });
        });
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });

    </script>
@endsection
