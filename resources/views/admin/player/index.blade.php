@extends('admin.master')
@section('player_nav_class', 'active')
@section('main_content')
    <div class="panel panel-default">
        <div  class="panel-heading"><h2 style="display: inline;">بازیکن ها</h2><a class="btn btn-primary" style="display: inline; float: left;padding: 5px;" href="{{route('make_player')}}">ایجاد بازیکن</a></div>

        <div style="padding-top: 15px; padding-bottom: 15px">
            <table class="table" id="stadium-table">
                <thead>
                <tr>
                    <th>نام</th>
                    <th>تیم</th>
                    <th>شماره بازیکن</th>
                    <th>سن</th>
                    <th>قد</th>
                    <th>وزن</th>
                </tr>
                </thead>
            </table>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#stadium-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: 'http://forecast.dev/api/player',
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
            "order": [[0, "asc"]],
            columns: [
                {data: 'name', name: 'name'},
                {
                    data: 'team.avatar', name: 'avatar', render: function (data) {
                    return '<img width="50px" src="' + data + '">';
                }
                },
                {data: 'number', name: 'number'},
                {data: 'age', name: 'age'},
                {data: 'height', name: 'height'},
                {data: 'weight', name: 'weight'}
            ]
        });
    </script>
@endsection