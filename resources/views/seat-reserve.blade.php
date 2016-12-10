@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>انتخاب قسمت</h3>
        </div>
        <div class="panel-body">
            <div style="padding-top: 15px; padding-bottom: 15px">
                <table class="table" id="positions-table">
                    <thead>
                    <tr>
                        <th>شماره صندلی</th>
                        <th>شماره ردیف</th>
                        <th>وضعیت</th>
                        <th>قیمت با کارت عضویت</th>
                        <th>قیمت با کارت ملی</th>
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
        var matchId = {{$needed['matchId']}};
        var positionId ={{$needed['positionId']}};
        var teamId ={{$needed['teamId']}};

        $('#positions-table').DataTable({
            processing: true,
            serverSide: true,

//           var matchId;

            ajax: "/api/user/reserve/seat?matchId="+{{$needed['matchId']}}+
            "&sectionId="+{{$needed['sectionId']}}+"&positionId="+{{$needed['positionId']}},
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
            "order": [[0, "desc"]],
            "searching": false,
            "bLengthChange": false,
            columns: [
                {data: 'SeatId', name: 'SeatId'},
                {data: 'RowNumber', name: 'RowNumber'},
                {
                    data: 'Status', name: 'Status', render: function (data) {
                    switch (data) {
                        case "Free":
                            return '<p style="color: green">Free</p>';
                            break;
                        case "Sale":
                            return '<p style="color: red">Sale</p>';
                            break;
                        case "Reserved":
                            return '<p style="color: black">reserved</p>';
                            break;
                        case "Company":
                            return '<p style="color: red">company</p>';
                            break;
                        case "NoActive":
                            return '<p style="color: blue">no active</p>';
                            break;
                        case "OnPay":
                            return '<p style="color: cyan">on pay</p>';
                            break;
                    }

                }
                },
                {
                    data: 'CardSeatPrice', name: 'CardSeatPrice'
                }
                ,
                {
                    data: 'IntCardSeatPrice', name: 'IntCardSeatPrice'
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        })
        ;


    </script>
@endsection