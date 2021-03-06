@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>انتخاب موقعیت</h3>
        </div>
        <div class="panel-body">
            <div style="padding-top: 15px; padding-bottom: 15px">
                <table class="table" id="positions-table">
                    <thead>
                    <tr>
                        <th>موقعیت</th>
                        <th>قیمت با کارت عضویت</th>
                        <th>قیمت با کارت ملی</th>
                        <th>تعداد بلیط باقی مانده</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $("#fakeLoader").fakeLoader({
            timeToHide: 1200, //Time in milliseconds for fakeLoader disappear
            zIndex: "999",//Default zIndex
            spinner: "spinner5",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
            bgColor: "#1A5B5B" //Hex, RGB or RGBA colors
        });
    </script>



    <script>

        $('#positions-table').DataTable({
            processing: true,
            serverSide: true,


            ajax: "/api/user/reserve/position?matchId=" +{{$needed['matchId']}}+"&teamId="+{{$needed['teamId']}},
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
            "bPaginate": false,
            columns: [
                {data: 'PositionName', name: 'PositionName'},
                {data: 'CardPositionPrice', name: 'CardPositionPrice'},
                {data: 'IntCardPositionPrice', name: 'IntCardPositionPrice'},
                {data: 'RemainingPositionSeats', name: 'RemainingPositionSeats'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });


    </script>
@endsection