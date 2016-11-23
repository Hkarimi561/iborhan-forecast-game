@extends('admin.master')
@section('main_content')
    <div class="panel panel-default">
        <div class="panel-heading"><h3 style="display: inline">رویداد های بازی : </h3>
            <h2 style="display: inline">{{$game['event_for_game']}}</h2>
            <p style="display: inline" id="game_time"></p>
            <p style="display: inline" id="game_date"></p>
            <p style="display: inline">در استادیوم : {{$game['stadium']}}</p></div>
        <div style="padding-top: 15px; padding-bottom: 15px">
            <table class="table" id="game-table">
                <thead>
                <tr>
                    <th>نوع رویداد</th>
                    <th>بازیکن</th>
                    <th>تیم</th>
                    <th>زمان رویداد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        //        moment().locale('fa').for;
        moment.loadPersian();
        var game_time = moment("{{$game['game_date']}}").locale('fa').format('HH:mm');
        var game_date = moment("{{$game['game_date']}}").locale('fa').format('jD jMMMM jYYYY');
        document.getElementById("game_time").innerHTML = "زمان بازی" + " " + game_time + " ";
        document.getElementById("game_date").innerHTML = "در تاریخ" + " " + game_date + " "
    </script>
    <script>
        $('#game-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: 'http://forecast.dev/api/game/event?game_id=' +{{$game['game_id']}},
            "language": {
                "sProcessing": "درحال پردازش...",
                "sLengthMenu": "نمایش محتویات _MENU_",
                "sZeroRecords": "موردی یافت نشد",
                "sInfo": "نمایش _START_ تا _END_ از مجموع _TOTAL_ مورد",
                "sInfoEmpty": "تهی",
                "sInfoFiltered": "(فیلتر شده از مجموع _MAX_ مورد)",
                "sInfoPostFix": "",
                "sSearch": "جستجو:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "ابتدا",
                    "sPrevious": "قبلی",
                    "sNext": "بعدی",
                    "sLast": "انتها"
                }
            },
            "order": [[3, "asc"]],
            columns: [
                {data: 'type', name: 'type'},
                {data: 'player.name', name: 'player'},
                {data: 'player.team.name', name: 'name'},
                {data: 'event_time', name: 'event_time'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endsection