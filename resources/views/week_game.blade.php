@extends('master')
@section('public_myforecast', 'active')
@section('main_content')
    <table class="table" id="weekGame">
        <thead>
        <tr>
            <th>تیم میزبان</th>
            <th>زمان بازی</th>
            <th>تاریخ بازی</th>
            <th>تیم میهمان</th>
            {{--<th>امتیاز شما</th>--}}
        </tr>
        </thead>
    </table>
    <div id="clock11"></div>
    <div id="massage"></div>
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

    <script>
        var first = moment().locale("fa").startOf('week').locale("en").format('YYYY-MM-DD');
        var end = moment().locale("fa").endOf('week').locale("en").format('YYYY-MM-DD');
        $('#weekGame').DataTable({
            processing: true,
            serverSide: true,


            ajax: '/api/game/week?start_date=' + first + '&end_date=' + end,
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
            "order": [[2, "asc"]],
            "searching": false,
            "bLengthChange": false,
            "bPaginate": true,
            columns: [
                {
                    data: 'home_team.avatar', name: 'home_team', render: function (data) {
                    return '<img width="50px" src="' + data + '">';
                }
                },
                {
                    data: 'game_time', name: 'game_time', render: function (data, type, full, meta) {
                    var id = meta.row;
                    moment.loadPersian();
                    var time = moment(data).format("HH:mm");
                    return '<div>' + time + '</div>'
                }
                },
                {
                    data: 'game_time', name: 'game_time', render: function (data, type, full, meta) {
                    var id = meta.row;
                    var date = moment(data).format("jDD jMMMM jYYYY");
                    return '<div>' + date + '</div>'
                }
                },
                {
                    data: 'away_team.avatar', name: 'away_team', render: function (data) {
                    return '<img width="50px" src="' + data + '">';
                }
                }
            ]

        });

    </script>
@endsection