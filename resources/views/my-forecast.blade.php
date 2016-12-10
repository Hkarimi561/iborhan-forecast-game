@extends('master')
@section('public_myforecast', 'active')
@section('main_content')
    <table class="table" id="myForecast">
        <thead>
        <tr>
            <th>بازی تیم های</th>
            <th>تیم میزبان</th>
            <th>تیم میهمان</th>
            <th>زمان ثبت نظر سنجی</th>
            <th>عملیات</th>
            {{--<th>امتیاز شما</th>--}}
        </tr>
        </thead>
    </table>
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
        moment.loadPersian();
        $('#myForecast').DataTable({
            processing: true,
            serverSide: true,


            ajax: '/api/user/myForecast?user_id=' + '{{$needed}}',
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
            "order": [[3, "desc"]],
            "searching": false,
            "bLengthChange": false,
            "bPaginate": true,
            columns: [
                {
                    data: 'away_team', name: 'away_team', "render": function (data, type, full, meta) {
                    return full.game.home_team.name + '-' + full.game.away_team.name;
                }
                },
                {data: 'home_point', name: 'home_point'},
                {data: 'away_point', name: 'away_point'},
                {
                    data: 'created_at', name: 'created_at', render: function (data) {
                    var mDate = moment(data);
                    return (mDate && mDate.isValid()) ? mDate.format("jD jMMMM jYYYY") : "";
                }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
//                {data: 'user_id', name: 'user_id'}
            ]
        });
    </script>
@endsection