<?php

namespace App\Http\Controllers;

use App\Jobs\CountScores;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $user_id = auth()->check() ? auth()->user()->id : 'null';
            $game = Game::where('game_time', '>', Carbon::now('Asia/Tehran')->addMinutes(45))->with('away_team', 'home_team', 'stadium')->get();
//        dd(Carbon::now('Asia/Tehran')->addMinutes(30));
            $needed = compact(['game','user_id']);
            return view('welcome')->with('needed', $needed);


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
    public function show($id)
    {
        //
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
    public function week_game()
    {
        return view('week_game');
    }
}
