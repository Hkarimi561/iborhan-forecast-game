@extends('master')
@section('public_game_reserve', 'active')
@section('main_content')




@endsection
@section('script')
    <script>
        var soapMessage =
                '<x:Envelope xmlns:x="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">' +
                '<x:Header/>' +
                '<x:Body>' +
                '<tem:StartPayment>' +
                '<tem:MatchId>157</tem:MatchId>' +
                '<tem:UserName>honarparvar</tem:UserName>' +
                '<tem:Password>123654789</tem:Password>' +
                '</tem:StartPayment>' +
                '</x:Body>' +
                '</x:Envelope>';
        /*$.ajax({
            url: 'http://89.165.5.100/FootballTicketService.asmx?wsdl',
            type: "POST",
            crossDomain: true,
            dataType: "xml",
            cache: false,
            Origin: "http://forecast.dev",
            data: soapMessage,
            processData: false,
            contentType: "text/xml; charset=\"utf-8\"",
            success: function(soapResponse){
                //DO SOMETHING
                console.log(soapResponse);
            }
        });*/

        http=new XMLHttpRequest();
        url="http://89.165.5.100/FootballTicketService.asmx?wsdl";
        params='UserName=honarparvar&Password=123654789&MatchId=157';


        http.open("POST",url,true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                alert(http.responseText);
            }
        }
        http.send(params);

    </script>
@endsection