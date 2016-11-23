<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use App\Models\ForecastQuestion;
use App\Models\Game;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ForecastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Carbon::now('+30'));
        $game_time = Game::all();
        $get_game = Game::where('game_time', '>', Carbon::now('Asia/Tehran')->addMinutes(45))->with('away_team', 'home_team', 'stadium')->where('status',null)->get();
//        dd($get_game->toArray());
//        return $get_game;
        return view('user.forecast')->with('games', $get_game);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $game_id = $id;
//        dd($id);
        $forecast_data = [
            'game_id' => $game_id,
            'home_point' => $request->get('home_point'),
            'away_point' => $request->get('away_point'),
            'user_id' => auth()->user()->id,
        ];
//        dd($forecast_data);
        $game = Forecast::whereUserId(auth()->user()->id)->whereGameId($game_id)->get()->first();
        if ($game == null) {
            Forecast::create($forecast_data);
        } else {
            if ($game_id == $game->game_id) {
                $data = [
                    'home_point' => $request->get('home_point'),
                    'away_point' => $request->get('away_point'),
                ];
                $id = $game->id;
                Forecast::find($id)->update($data);

            } else {
                dd("asqar");
                Forecast::create($forecast_data);

            }
        }


        return redirect()->back()->with('success', 'Game has been added');
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
//        dd($request->toArray());
        $needed = $request->get('id');
        return view('my-forecast')->with('needed', $needed);
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
}
