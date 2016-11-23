<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CountScores;
use App\Models\Answer;
use App\Models\Forecast;
use App\Models\ForecastQuestion;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Question;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class GameController extends Controller
{

    public function __construct()
    {
//        $this->middleware(['auth'])->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.game.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $get_team = Team::all();
        $get_stadium = Stadium::all();
        $get_question = Question::all();

        return view('admin.game.create')->with('teams', $get_team)->with('stadiums', $get_stadium)->with('questions', $get_question);
//        return view('admin.game');
//dd($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game_time = $request['game_date'] = Carbon::parse(request()['game_date'])->format('Y-m-d') . ' ' . $request['game_time'] = Carbon::parse(request()['game_time'])->format('H:i');

        $game_data = [
            'home_id' => $request->get('home_id'),
            'away_id' => $request->get('away_id'),
            'stadium_id' => $request->get('stadium_id'),
            'game_time' => $game_time,

        ];
        $question = json_encode($request->get('question'));

        $game = Game::create($game_data);

        $question_data = [
            'game_id' => $game['id'],
            'question_id' => $question
        ];
        ForecastQuestion::create($question_data);
        return redirect()->back()->with('success', 'Game has been added');
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

    public function endGame(Request $request)
    {
        $gameId = $request['game_id'];
        $game = Game::whereId($gameId);
        $home_id = $game->get()->first()['home_id'];
        $away_id = $game->get()->first()['away_id'];

        $home_point = GameEvent::whereGameId($game->get()->first()['id'])->where('team_id', $home_id)->where('type', 'goal')->count();
        $away_point = GameEvent::whereGameId($game->get()->first()['id'])->where('team_id', $away_id)->where('type', 'goal')->count();
        $forecasts = Forecast::whereGameId($game->get()->first()['id'])->get();
        $forecast_question = ForecastQuestion::whereGameId($game->get()->first()['id'])->get()->first()->toArray();

        foreach ($forecasts as $forecast) {
            $user = User::whereId($forecast['user_id'])->get()->first();
            $answer =Answer::whereForecastId($forecast['id'])->get()->first();
            $answer = json_decode($answer['answer']);
//            dd($answer);
            $events=GameEvent::whereGameId($game->get()->first()['id'])->with('player')->get()->toArray();
//        dd($events);

//            dd($question);
//            dd($forecast['id']);
//            dump($forecast);
            foreach ($events as $key=>$event) {
//                dd($key);
                if ($event['type'] == 'goal'){
                    $question[] = Question::where('event','goal')->get()->toArray();
                    if ($event['player']['name'] ==$answer[$key]){
                        $score=$user['score']+10;
                        $user->where('id', $forecast['user_id'])->update(['score' => $score]);
//                        dd($score);
                    }
                }elseif ($event['type'] == 'best'){
                    $question[] = Question::where('event','best')->get()->toArray();
                    if ($event['player']['name'] ==$answer[$key]){
                        $score=$user['score']+10;
                        $user->where('id', $forecast['user_id'])->update(['score' => $score]);
                        dd($score);
                    }
                }

            }

            if ($home_point == $forecast['home_point'] && $away_point == $forecast['away_point']) {
                $score = $user['score'] + 20;
                $user->where('id', $forecast['user_id'])->update(['score' => $score]);
                $forecast->update(['status' => 2]);


            } elseif ($home_point == $forecast['home_point'] || $away_point == $forecast['away_point']) {
                $score = $user['score'] + 10;
                $user->where('id', $forecast['user_id'])->update(['score' => $score]);
                $forecast->update(['status' => 1]);
            } else {
                $forecast->update(['status' => 0]);
            }
        }
        $game->update(['status' => true]);
        return redirect()->back()->with('success', 'Game has been updated');

    }
}
