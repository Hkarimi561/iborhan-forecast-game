<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GameEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $game = Game::where('id', $request['id'])->first();
//        $home_player=Player::whereTeamId($game['home_id'])->get();
//        $away_player=Player::whereTeamId($game['away_id'])->get();
//        dd($home_player->toArray());
        return view('admin.event.event-creator')->with('game', $game);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->toArray());
        $data = [
            'type' => $request->get('type'),
            'team_id' => $request->get('team_id'),
            'player_id' => $request->get('player_id'),
            'game_id' => $request->get('game_id'),
            'event_time' => $request->get('event_time')

        ];

        GameEvent::create($data);
        return redirect()->back()->with('success', 'Event has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $gameEvents = GameEvent::whereGameId($request['game_id'])->with(['game', 'team', 'player', 'game.away_team', 'game.home_team', 'game.stadium'])->get()->toArray();
        if ($gameEvents) {
            Carbon::setLocale('fa');
            $event_for_game = $gameEvents[0]['game']['home_team']['name'] . ' ' . 'و' . ' ' . $gameEvents[0]['game']['away_team']['name'];
            $game_date = Carbon::parse($gameEvents[0]['game']['game_time']);

            $game_id = $request->get('game_id');
            $stadium = $gameEvents[0]['game']['stadium']['name'];
            $needed = compact('event_for_game', 'game_id', 'game_date', 'game_time', 'stadium');
            return view('admin.event.game-event')->with('game', $needed);
        } else {
            return redirect()->back()->with('warning', 'No Event Founded');
        }
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
