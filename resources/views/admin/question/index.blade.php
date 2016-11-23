@extends('admin.master')
@section('question_nav_class', 'active')
@section('main_content')
    <div class="panel panel-default">
        <div  class="panel-heading"><h2 style="display: inline;">سوال ها</h2><a class="btn btn-primary" style="display: inline; float: left;padding: 5px;" href="{{route('make_question')}}">ایجاد سوال</a></div>
        <div style="padding: 15px;">
            <table class="table" id="question-table">
                <thead>
                <tr>
                    <th>سوال</th>
                    <th>نوع فیلد</th>
                    <th>نوع رویداد</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#question-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: 'http://forecast.dev/api/question',
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
                {data: 'question', name: 'question'},
                {data: 'type', name: 'type'},
                {data: 'event', name: 'event'}
            ]
        });
    </script>
@endsection