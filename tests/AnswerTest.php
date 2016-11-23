<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnswerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

//        $this->visit('user/login')->type('hkarimi561@gmail.com','email')->type('3241253724','password')->press('confirm')->seePageIs('/')->seeIsAuthenticated();
        $this->visit('user/login')->type('hkarimi561@gmail.com','email')->type('3241253724','password')->press('confirm')->visit('user/game/forecast')->type('2','home_point')->type('3','away_point')->press('upload')->followRedirects()->seePageIs('user/game/forecast')->seeInDatabase('answer',['forecast_id'=>'5']);
    }
}
