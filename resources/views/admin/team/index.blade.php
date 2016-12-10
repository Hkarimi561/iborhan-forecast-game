@extends('admin.master')
@section('team_nav_class', 'active')
@section('main_content')
    <div class="panel panel-default">
        <div  class="panel-heading"><h2 style="display: inline;">تیم ها</h2><a class="btn btn-primary" style="display: inline; float: left;padding: 5px;" href="{{route('make_team')}}">ایجاد تیم</a></div>
        <div style="padding: 15px;">
            <table class="table" id="team-table">
                <thead>
                <tr>
                    <th>نام</th>
                    <th>لوگو</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#team-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: '/api/team',
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
            "bPaginate": true,
            "order": [[0, "asc"]],
            columns: [
                {data: 'name', name: 'name'},
                {
                    data: 'avatar', name: 'avatar', render: function (data) {
                    return '<img width="50px" src="' + data + '">';
                }
                }
            ]
        });
    </script>
@endsection