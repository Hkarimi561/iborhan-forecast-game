@extends('admin.master')
@section('game_nav_class', 'active')
@section('main_content')
    <div class="panel panel-default">
        <div  class="panel-heading"><h2 style="display: inline;">بازی ها</h2><a class="btn btn-primary" style="display: inline; float: left;padding: 5px;" href="{{route('make_game')}}">ایجاد بازی</a></div>
        <div style="padding: 15px;">
            <table class="table" id="question-table">
                <thead>
                <tr>
                    <th>تیم میزبان</th>
                    <th>تیم میهمان</th>
                    <th>زمان بازی</th>
                    <th>تاریخ بازی</th>
                    <th>محل برگزاری بازی</th>
                    <th>وضعیت بازی</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        moment.loadPersian();
        $('#question-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: '/api/game/data',
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
            "searching": false,
            "bLengthChange": false,
            "bPaginate": false,
            "order": [[3, "desc"]],
            columns: [
                {data: 'home_team.name', name: 'home_team'},
                {data: 'away_team.name', name: 'away_team'},
                {data: 'game_time', name: 'game_time',render:function (data) {
                    var mDate = moment(data.date);
                    return (mDate && mDate.isValid()) ? mDate.format("HH:mm") : "";
                }},
                {data: 'game_time', name: 'game_time',render:function (data) {
                    var mDate = moment(data.date);
                    return (mDate && mDate.isValid()) ? mDate.format("jD jMMMM jYYYY") : "";
                }},
                {data: 'stadium.name', name: 'stadium'},
                {data: 'status', name: 'status',render:function (data) {
                    if (data == 1){
                        return 'بازی خاتمه یافته است'
                    }else {
                        return 'بازی خاتمه نیافته است'
                    }
                }}
            ]
        });
    </script>
@endsection