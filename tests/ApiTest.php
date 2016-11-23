<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUserForecast()
    {

        $this->get('api/user/myForecast?user_id=3')->seeJsonStructure(
            [
                'draw','recordsTotal','recordsFiltered',
                'data'
            ]
        );
    }
    public function testGetUserForecastInfo()
    {
        $this->get('api/user/myForecastInfo?user_id=3')->seeJsonStructure(
            [
                'forecast_count','true_forecast','false_answer',
                'mid_forecast','score'
            ]
        );
    }


}
