@extends('admin.master')
@section('game_nav_class', 'active')
@section('main_content')
    <h1 class="page-header">ایجاد بازی</h1>
    <div class="">
        <form class="form-upload" id="question" action="{{ route('game_add') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <select class="js-example-basic-single" name="home_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <select class="js-example-basic-single" name="away_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <select class="js-example-basic-single" name="stadium_id">
                    @foreach($stadiums as $stadium)
                        <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                {{--<input type="text" id="datepicker" name="game_date">--}}
            </div>
            <div class="row">
                <input type="text" id="game_date"/>
                <input type="hidden" name="game_date" id="date">
            </div>
            <div class="row">
                <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="09:30" name="game_time">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
                </div>
            </div>
            <div id="date">

            </div>
            <div class="row">
                <div id="question_fields">
                    <select class="js-example-basic-single" name="question[]">
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </select>
                    <input type="button" id="more_fields" onclick="add_fields();" value="Add More"/>
                </div>
            </div>
            <div class="row">
                <input class="btn btn-lg btn-primary btn-block" type="submit" id="submit" value="ثبت" name="upload">
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                    <p>{{ session('success') }}</p>
                </div>
            @endif
        </form>


    </div>
@endsection
@section('script')
    <script>

        //        dateDropper().dropWidth('600');

        //        console.log(moment($("#game_date").val(), 'jDD-jMM-jYYYY').format('YYYY-MM-DD'))
        $("#game_date").dateDropper({
            dropWidth: 300,
//            format:"m/F/Y"

        });

        $("#game_date").change(function () {
//            console.log(moment($("#game_date").val(),'jDD-jMM-jYYYY').format('YYYY-MM-DD'));
            var date =moment($("#game_date").val(),'jDD-jMM-jYYYY').format('YYYY-MM-DD');
            console.log(date);
            $("#date").val(moment($("#game_date").val(),'jDD-jMM-jYYYY').format('YYYY-MM-DD'));
//            $("#date").innerHTML='<input type='>'
                }
        );


    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker();
    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>
    <script>

        var question = 1;
        function add_fields() {
            question++;
            var objTo = document.getElementById('question_fields');
            var divtest = document.createElement("div");
            divtest.innerHTML = '<select class="js-example-basic-single" name=' + "question" + '[]' + '>' +
                    '@foreach($questions as $question)' +
                    '<option value="{{ $question->id }}">{{ $question->question }}</option>' +
                    '@endforeach' +
                    '</select>';

//            <input type="hidden" name='" + hname + " ' value=' " + hvalue + " '/><br/>
            objTo.appendChild(divtest)
        }
    </script>



@endsection
