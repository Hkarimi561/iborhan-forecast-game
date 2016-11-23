@extends('admin.master')
@section('home_nav_class', 'active')
@section('main_content')
    <div class="test-message">
        @if(Session::has('warning'))
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{ session('warning') }}</p>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{ session('success') }}</p>
            </div>
        @endif
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h2>بازی های خاتمه نیافته</h2></div>
        <div style="padding-top: 15px; padding-bottom: 15px">
            <table class="table" id="game-table">
                <thead>
                <tr>
                    <th>تیم میزبان</th>
                    <th>تیم میهمان</th>
                    <th>زمان بازی</th>
                    <th>تاریخ بازی</th>
                    <th>محل برگزاری بازی</th>
                    <th>عملیات</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>

@endsection

@section('script')

    <script>
        moment.loadPersian();
        $('#game-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://forecast.dev/api/game/start/data',
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

            columns: [
                {data: 'home_team.name', name: 'home_team'},
                {data: 'away_team.name', name: 'away_team'},
                {
                    data: 'game_time', name: 'game_time', render: function (data) {
                    var mDate = moment(data.date);
                    return (mDate && mDate.isValid()) ? mDate.format("HH:mm") : "";
                }
                },
                {
                    data: 'game_time', name: 'game_time', render: function (data) {
                    var mDate = moment(data.date);
                    return (mDate && mDate.isValid()) ? mDate.format("jD jMMMM jYYYY") : "";
                }
                },
                {data: 'stadium.name', name: 'stadium'},

                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endsection