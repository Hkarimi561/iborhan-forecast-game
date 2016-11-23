<?php

namespace App\Http\Controllers;

use App\EticketSoapModel;
use App\Models\FootballETicket;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpParser\Serializer\XML;
use Symfony\Component\Routing\Loader\XmlFileLoader;

class GameReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('game-reserve');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $needed = $request->toArray();
//        dd($needed);
        return view('position-reserve')->with('needed', $needed);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function section(Request $request)
    {
        $needed = $request->toArray();
        return view('section-reserve')->with('needed', $needed);
    }

    public function seat(Request $request)
    {
        $needed = $request->toArray();
        return view('seat-reserve')->with('needed', $needed);
    }

    public function setSeatReserve(Request $request)
    {

        $validate = FootballETicket::where('user_id', auth()->user()->id)->get()->toArray();
//        dd($validate);
        if ($validate != null) {
//            dd($request->toArray());
            $needed = $request->toArray();
            $val = 1;

            $soap = new EticketSoapModel();

            $data = [
                'SeatRow' => $request->toArray()['seatRow'],
                'SeatNum' => $request->toArray()['seatNum'],
                'SectionID' => $request->toArray()['sectionId'],
                'MatchId' => $request->toArray()['matchId'],
                'USName' => $validate[0]['username'],
                'Password' => $validate[0]['password'],
            ];
            $payData = [
                'MatchId' => $request->toArray()['matchId'],
                'UserName' => $validate[0]['username'],
                'Password' => $validate[0]['password'],
            ];
            collect($soap->setSeatReseve($data));
            return view('reserve')->with('needed', $needed)->with('val',$val);
        } else {
            $needed = $request->toArray();
            return view('reserve')->with('needed', $needed);
        }

    }

    public function setCardNumber(Request $request)
    {

        $user = FootballETicket::where('user_id', auth()->user()->id)->get()->toArray();
        if ($request->toArray()['cardNumber']!=null){
            $cardNumber=$request->toArray()['cardNumber'];
        }
        else{
            $cardNumber=$request->toArray()['nationalCode'];
        }

        $soap = new EticketSoapModel();
        $data=[
            "MatchID"=>$request->toArray()['matchId'],
            "PositionID"=>$request->toArray()['posId'],
            "SeatRow"=>$request->toArray()['seatRow'],
            "SeatNum"=>$request->toArray()['seatNum'],
            "CardNumber"=>$cardNumber,
            "Username"=>$user[0]['username'],
            "SectionID"=>$request->toArray()['sectionId'],
            "Password"=>$user[0]['password']
        ];
        $result=collect($soap->setSeatCardNumber($data));
//        dd($result);
        if ($result[0]=="Success"){
            $paymentData=[
                "MatchId"=>$request->toArray()['matchId'],
                "UserName"=>$user[0]['username'],
                "Password"=>$user[0]['password']
            ];

        return view('payment')->with('data',$paymentData);
        }
    }

    public function payment(Request $request)
    {
        $validate = FootballETicket::where('user_id', auth()->user()->id)->get()->toArray();
        $soap = new EticketSoapModel();
        $data=[
            'MatchId' => $request->toArray()['matchId'],
            'UserName' => $validate[0]['username'],
            'Password' => $validate[0]['password'],
        ];
        $payment=collect($soap->startPayment($data));
        dd($payment);
    }

    public function footballETicketUserValidation(Request $request)
    {
        $soap = new EticketSoapModel();

        $data = [
            'UserName' => $request->toArray()['user_name'],
            'Password' => $request->toArray()['password'],
        ];
        $userValidate = collect($soap->getUserValidate($data));
        if ($userValidate[0] != -1) {
            $football_e_ticket_data = [
                'user_id' => auth()->user()->id,
                'username' => $request->toArray()['user_name'],
                'password' => $request->toArray()['password'],
                'validate' => $userValidate[0]
            ];
            FootballETicket::create($football_e_ticket_data);
            return redirect()->back()->with('success', 'با تشکر از اعتماد شما');
        }
        return redirect()->back()->with('error', 'نام کاربری شما وجود ندارد');
    }

    public function Position()
    {
        return view('position');
    }
    public function selectSection()
    {
        return view('section');
    }

    public function demoSoap()
    {
        return view('paymentt');
        // Add a new service to the wrapper

//        SoapWrapper::add(function ($service) {

//            $header = [
//                'UserCredentials' => [
//                    'UserName' => 'hkarimi561',
//                    'Password' => '3241253724'
//                ]
//
//            ];
//            $service
//                ->name('eticket')
//                ->wsdl('http://89.165.5.100/FootballTicketService.asmx?wsdl')
//                ->header('eticket', 'UserCredentials', [
//                    'UserName' => 'hkarimi561',
//                    'Password' => '3241253724'
//                ])
//                ->trace(true)
//                ->cache(WSDL_CACHE_NONE);
//        });
//
//
//        $data = [
//            'MatchId' => '157',
//            'UserName' => 'honarparvar',
//            'Password' => '123654789',
//
//        ];
//
//        SoapWrapper::service('eticket', function ($service) use ($data) {
//            dump($service->getFunctions());
//            dump($service->call('GetMatchs', [$data])->GetMatchsResult);
//            dump($service->call('GetPositions', [$data])->GetPositionsResult);
//            dump($service->call('GetSections', [$data])->GetSectionsResult);
//            dump($service->call('StartPayment', [$data])->StartPaymentResult);
//        });
    }
}
