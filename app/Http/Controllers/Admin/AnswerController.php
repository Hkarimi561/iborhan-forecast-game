<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Forecast;
use App\Models\ForecastQuestion;
use App\Models\Game;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $game_id = $request->get('game_id');

//        dd($request->toArray());
        $forecast_data = [
            'game_id' => $request->get('game_id'),
            'home_point' => $request->get('home_point'),
            'away_point' => $request->get('away_point'),
            'user_id' => auth()->user()->id,
        ];
        $game = Forecast::whereUserId(auth()->user()->id)->whereGameId($game_id)->get()->first();

        if ($game == null) {

            $forecast = Forecast::create($forecast_data);
            $answer = json_encode($request->get('answer'));

//            dd($answer);
            $answer_data = [
                'forecast_id' => $forecast['id'],
                'answer' => $answer
            ];
            Answer::create($answer_data);
        } else {

            if ($game_id == $game->game_id) {
                $data = [
                    'home_point' => $request->get('home_point'),
                    'away_point' => $request->get('away_point'),
                ];
                $id = $game->id;
                Forecast::find($id)->update($data);
                $forecast = Forecast::whereId($id)->get()->first();
                $answer = Answer::whereForecastId($forecast['id'])->get()->first();
                if ($answer == null) {
                    $answer = json_encode($request->get('answer'));
//                    dd($answer);
                    $answer_data = [
                        'forecast_id' => $forecast['id'],
                        'answer' => $answer
                    ];
                    Answer::create($answer_data);
                } else {
                    if ($forecast['id'] == $answer->forecast_id) {
                        $id=$answer->id;
                        $answer = json_encode($request->get('answer'));
                        $data = [
                            'answer'=>$answer
                        ];

                        Answer::find($id)->update($data);
                    }else{

                        $answer = json_encode($request->get('answer'));
                        dd($answer);
                        $answer_data = [
                            'forecast_id' => $forecast['id'],
                            'answer' => $answer
                        ];
                        Answer::create($answer_data);
                    }
                }
            } else {

                $forecast = Forecast::create($forecast_data);
                $answer = json_encode($request->get('answer'));
                $answer_data = [
                    'game_id' => $forecast['id'],
                    'answer' => $answer
                ];
                Answer::create($answer_data);
            }
        }
//        $forecast=Forecast::create($forecast_data);
//        $answer = json_encode($request->get('answer'));
//        dd($answer);
//        $answer_data=[
//            'game_id'=>$forecast['id'],
//            'answer'=>$answer
//        ];
//        Answer::create($answer_data);
        return redirect()->back()->with('success', 'Forecast has been Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $game_forecast = Game::with(['home_team', 'away_team', 'stadium'])->where('id', $id)->get();
        $get_question = ForecastQuestion::where('game_id', $id)->first();
        $get_question = json_decode($get_question->question_id);
        $question_count = count($get_question);
        $questions = Question::where('id', $get_question[0])->get();
        for ($i = 0; $i < $question_count; $i++) {
            $question_id = $get_question[$i];
            $question = Question::where('id', $question_id)->get();
            $questions = $questions->merge($question);
        };
        return view('user.forecast_answer')->with('game', $game_forecast)->with('questions', $questions);
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
