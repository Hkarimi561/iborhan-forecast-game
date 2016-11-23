<?php

namespace App\Http\Controllers;

use App\EticketSoapModel;
use App\Models\Forecast;
use App\Models\Game;
use App\Models\GameEvent;
use App\Models\Player;
use App\Models\Question;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Symfony\Component\DomCrawler\Crawler;
use Yajra\Datatables\Facades\Datatables;

class ApiController extends Controller
{
    public function get_team_player(Request $request)
    {
        $player = Player::whereTeamId($request['id'])->get(['id', 'name']);
        return $player->map(function ($player) {
            return [
                'id' => $player->id,
                'text' => $player->name
            ];
        });
    }

    public function getStartedGameData()
    {
        $game = Game::where('game_time', '<=', Carbon::now())->with('away_team', 'home_team', 'stadium')->where('status', null)->get();

        foreach ($game as $g) {
            $g['game_time'] = Carbon::parse($g['game_time']);
        }

        return Datatables::of($game)->addColumn('action', function ($game) {
            return '<a href="' . route('make_event', ['id' => $game->id]) .
            '"class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>  ایجاد رویداد</a>' . ' ' .
            '<a href="' . route('view_event', ['game_id' => $game->id]) .
            '"class="btn btn-warning"><i class="fa fa-file-text" aria-hidden="true"></i> نمایش رویداد ها</a>' . ' ' .
            '<a href="' . route('end_game', ['game_id' => $game->id]) .
            '"class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> پایان بازی</a>';
        })->make(true);
    }

    public function getGameData()
    {
        $game = Game::all()->load(['home_team', 'away_team', 'stadium'])->sortByDesc('game_time');

        foreach ($game as $g) {
            $g['game_time'] = Carbon::parse($g['game_time']);
        }
        return Datatables::of($game)->make(true);
    }

    public function getGameEvent(Request $request)
    {
        $gameEvents = GameEvent::whereGameId($request->get('game_id'))->with(['player', 'player.team'])->get()->sortBy('event_time');


        return Datatables::of($gameEvents)->addColumn('action', function ($game) {
            return '<a href="' . route('edit_event', ['id' => $game->id]) . '"class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>  ویرایش</a>';
        })->make(true);
    }

    public function getStadium()
    {
        $stadium = Stadium::all();


        return Datatables::of($stadium)->make(true);
    }

    public function getPlayer()
    {
        $player = Player::with('team');


        return Datatables::of($player)->make(true);
    }

    public function getTeam()
    {
        $team = Team::all();


        return Datatables::of($team)->make(true);
    }

    public function getQuestion()
    {
        $question = Question::all();


        return Datatables::of($question)->make(true);
    }

    public function getMyForecast(Request $request)
    {

        $myGameForecast = Forecast::whereUserId($request->get('user_id'))->with(['game', 'game.home_team', 'game.away_team'])->get()->sortBy('created_at');
//            dd($myGameForecast->toArray());

        return Datatables::of($myGameForecast)->addColumn('action', function ($game) {
            if ($game['game']['game_time'] > Carbon::now('Asia/Tehran')->addMinutes(45)) {
                return '<a href="' . route('forecast_answer', ['id' => $game->id]) . '"class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>  ویرایش نتیجه و پاسخ سوالات</a>';
            } else {
                return '<p>زمان پاسخ دهی و ویرایش سوالات به اتمام رسیده .</p>';
            }
        })->make(true);
    }

    public function getMyForecastInfo(Request $request)
    {

        $forecast = Forecast::whereUserId($request['user_id'])->whereNotNull('status')->get();
        $forecast_count = $forecast->count();
        $true_forecast = $forecast->where('status', 1)->count();
        $mid_forecast = $forecast->where('status', 2)->count();
        $false_answer = $forecast_count - ($true_forecast + $mid_forecast);
        $user = User::whereId($request['user_id'])->get()->first()->toArray();
        $score = $user['score'];
        $data = compact('forecast_count', 'true_forecast', 'my_point', 'false_answer', 'mid_forecast', 'score');
//        dd($data);
        return response($data);
    }

    public function getWeekGame(Request $request)
    {
        $game = Game::whereBetween('game_time', [$request['start_date'], $request['end_date']])->with(['home_team', 'away_team'])->get();
        return Datatables::of($game)->make(true);
    }

    public function getSevenDayLaterGame()
    {
        $game = Game::whereBetween('game_time', [Carbon::now(), Carbon::now()->addDays(7)])->with(['home_team', 'away_team', 'stadium'])->get()->toArray();
        return response($game);
    }

    public function getMatch()
    {
        $soap = new EticketSoapModel();
        return response(collect($soap->getMatches()->Matchs));
    }

    public function getPositions(Request $request)
    {
        $soap = new EticketSoapModel();
        $data = [
            "MatchId" => $request->toArray()['matchId']
        ];
        $positions = collect($soap->getPositions($data)->Positions);
        return Datatables::of($positions)->addColumn('action', function ($position) use ($request) {
            if ($position->RemainingPositionSeats > 0) {
                return '<a href="' . route('section_reserve',
                    ['matchId' => $request->toArray()['matchId'], 'positionId' => $position->PositionId, 'teamId' => $request->toArray()['teamId']]) . '"class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> انتخاب موقعیت</a>';
            } else {
                return '<p>ظرفیت این موقعیت پر است</p>';
            }
        })->make(true);
    }

    public function getSections(Request $request)
    {
        $soap = new EticketSoapModel();

        $data = [
            'MatchId' => $request->toArray()['matchId'],
            'PositionId' => $request->toArray()['positionId'],
            'TeamId' => $request->toArray()['teamId'],
        ];


        $sections = collect($soap->getSections($data)->Sections);
        return Datatables::of($sections)->addColumn('action', function ($section) use ($request) {
            if ($section->RemainingSectionSeats != 0) {
                return '<a href="' . route('seat_reserve',
                    ['matchId' => $request->toArray()['matchId'], 'sectionId' => $section->SectionId, 'teamId' => $request->toArray()['teamId'], 'positionId' => $request->toArray()['positionId']]) . '"class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> انتخاب موقعیت</a>';
            } else {
                return '<p>ظرفیت این موقعیت پر است</p>';
            }
        })->make(true);
    }

    public function getSeats(Request $request)
    {
//        dd($request->toArray());
        $soap = new EticketSoapModel();

        $data = [
            'MatchId' => $request->toArray()['matchId'],
            'SectionId' => $request->toArray()['sectionId'],
        ];


        $seats = collect($soap->getSeats($data)->Seats);
        return Datatables::of($seats)
            ->addColumn('action', function ($seat) use ($request) {
            return '<a href="' . route('set_seat_reserve',
                ['matchId' => $request->toArray()['matchId'], 'sectionId' => $request->toArray()['sectionId'],'seatRow' => $seat->RowNumber,'seatNum'=>$seat->SeatNumber,'posId'=>$request->toArray()['positionId']]) . '"class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i> انتخاب صندلی</a>';
        })
            ->make(true);

    }
}
