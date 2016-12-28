<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);
Route::get('social/login/{provider}', ['uses' => 'Auth\AuthController@handleProviderCallback', 'as' => 'social.callback']);
Route::resource('telegram','TelegramController');
Route::group(['middleware' => 'guest'], function () {

    Route::get('/user/login', ['as' => 'user-get-login', 'uses' => 'Auth\AuthController@get_login']);
    Route::post('/user/login', ['before' => 'csrf', 'as' => 'user-login', 'uses' => 'Auth\AuthController@login']);
    Route::get('/user/register', ['as' => 'user-register', 'uses' => 'Auth\AuthController@get_register']);
    Route::post('user/register',['before' => 'csrf', 'as' => 'register', 'uses' => 'Auth\AuthController@create']);
/*
    Route::get('/user/login', ['as' => 'admin-get-login', 'uses' => 'Auth\AuthController@get_login']);
    Route::post('/user/login', ['before' => 'csrf', 'as' => 'user-login', 'uses' => 'Auth\AuthController@post_login']);*/
});

//start Admin login route
Route::get('/admin/login', 'AdminAuth\AuthController@showLoginForm');
Route::post('/admin/login', ['as' => 'admin-login', 'uses' => 'AdminAuth\AuthController@login']);
//Route::get('/admin/password/reset', 'AdminAuth\PasswordController@resetPassword');
//end admin login route
//start Admin routes
Route::group(['middleware' => ['admin']], function () {
    //Login Routes...
    Route::get('/logout', 'AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('/register', 'AdminAuth\AuthController@register');

    Route::get('/admin','Admin\Employee@index');

    Route::get('/question', ['as' => 'question', 'uses' => 'Admin\QuestionController@index']);
    Route::get('/question/create', ['as' => 'make_question', 'uses' => 'Admin\QuestionController@create']);
    Route::post('/question/add', ['before' => 'csrf', 'as' => 'question_add', 'uses' => 'Admin\QuestionController@store']);

    Route::get('/team', ['as' => 'team', 'uses' => 'Admin\TeamController@index']);
    Route::get('/team/create', ['as' => 'make_team', 'uses' => 'Admin\TeamController@create']);
    Route::post('/team/add', ['before' => 'csrf', 'as' => 'team_add', 'uses' => 'Admin\TeamController@store']);



    Route::get('/stadium', ['as' => 'stadium', 'uses' => 'Admin\StadiumController@index']);
    Route::get('/stadium/create', ['as' => 'stadium_create', 'uses' => 'Admin\StadiumController@create']);
    Route::post('/stadium/add', ['before' => 'csrf', 'as' => 'stadium_add', 'uses' => 'Admin\StadiumController@store']);

    Route::get('/game', ['as' => 'game', 'uses' => 'Admin\GameController@index']);
    Route::get('/game/store', ['as' => 'make_game', 'uses' => 'Admin\GameController@create']);
    Route::post('/game/add', ['before' => 'csrf', 'as' => 'game_add', 'uses' => 'Admin\GameController@store']);

    Route::get('/player', ['as' => 'player', 'uses' => 'Admin\PlayerController@index']);
    Route::get('/player/create', ['as' => 'make_player', 'uses' => 'Admin\PlayerController@create']);
    Route::post('/player/add', ['before' => 'csrf', 'as' => 'player_add', 'uses' => 'Admin\PlayerController@store']);

    Route::get('/event/create', ['as' => 'make_event', 'uses' => 'Admin\GameEventController@create']);
    Route::post('/event/add', ['before' => 'csrf', 'as' => 'event_add', 'uses' => 'Admin\GameEventController@store']);

    Route::get('/event/view', ['as' => 'view_event', 'uses' => 'Admin\GameEventController@show']);
    Route::get('/event/edit', ['as' => 'edit_event', 'uses' => 'Admin\GameEventController@edit']);

    Route::get('/count/score',['as'=>'end_game','uses'=>'Admin\GameController@endGame']);
});
//end Admin routes
Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/user', 'middleware' => 'auth'], function () {
        Route::get('/game/reserve',['as'=>'game_reserve','uses'=>'GameReserveController@index']);
        Route::get('/matches/reserve',['as'=>'match_reserve','uses'=>'GameReserveController@show']);
        Route::get('/section/reserve',['as'=>'section_reserve','uses'=>'GameReserveController@section']);
        Route::get('/seat/reserve',['as'=>'seat_reserve','uses'=>'GameReserveController@seat']);
        Route::get('/seat/reserve/set',['as'=>'set_seat_reserve','uses'=>'GameReserveController@setSeatReserve']);
        Route::get('/seat/reserve/payment',['as'=>'reserve_payment','uses'=>'GameReserveController@payment']);

        Route::get('/select/position',['as'=>'select_position','uses'=>'GameReserveController@Position']);
        Route::get('/select/section',['as'=>'select_section','uses'=>'GameReserveController@demoSoap']);

        Route::post('/football_e_ticket/user/validate',['as'=>'football_e_ticket_validate','uses'=>'GameReserveController@footballETicketUserValidation']);
        Route::post('/football_e_ticket/user/validate',['as'=>'football_e_ticket_validate','uses'=>'GameReserveController@footballETicketUserValidation']);
        Route::post('/football_e_ticket/user/card/number',['as'=>'football_e_ticket_number','uses'=>'GameReserveController@setCardNumber']);

        Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

        Route::get('/user/complete-info', ['as' => 'complete_info', 'uses' => 'Admin\UserController@index']);
        Route::post('/user/submit', ['before' => 'csrf', 'as' => 'user_submit', 'uses' => 'Admin\UserController@update']);

        Route::get('/game/forecast', ['as' => 'forecast', 'uses' => 'ForecastController@index']);
        Route::post('/game/castsubmit/{id}', ['before' => 'csrf', 'as' => 'forecast_submit', 'uses' => 'ForecastController@create']);

        Route::get('/my/forecast', ['as' => 'my_forecast', 'uses' => 'ForecastController@show']);

        Route::get('/forecast/answer', ['as' => 'forecast_answer', 'uses' => 'Admin\AnswerController@show']);
        Route::post('/forecast/add', ['before' => 'csrf', 'as' => 'answer_submit', 'uses' => 'Admin\AnswerController@store']);

    });
});

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/game/week', ['as' => 'week_game', 'uses' => 'HomeController@week_game']);
Route::group(['prefix' => 'api'], function() {
    Route::get('/team/player','ApiController@get_team_player');

    Route::get('/game/start/data','ApiController@getStartedGameData');
    Route::get('/game/data','ApiController@getGameData');
    Route::get('/game/event','ApiController@getGameEvent');
    Route::get('/stadium','ApiController@getStadium');
    Route::get('/player','ApiController@getPlayer');
    Route::get('/team','ApiController@getTeam');
    Route::get('/question','ApiController@getQuestion');
    Route::get('/game/week','ApiController@getWeekGame');
    Route::get('/seven','ApiController@getSevenDayLaterGame');
});
Route::group(['prefix' => 'api/user','middleware' => ['web']], function() {
    Route::get('/myForecast','ApiController@getMyForecast');
    Route::get('/myForecastInfo','ApiController@getMyForecastInfo');
    Route::get('/reserve/matches','ApiController@getMatch');
    Route::get('/reserve/position','ApiController@getPositions');
    Route::get('/reserve/section',['as' => 'section_selector', 'uses' => 'ApiController@getSections']);
    Route::get('/reserve/seat',['as' => 'seat_selector', 'uses' => 'ApiController@getSeats']);

});


