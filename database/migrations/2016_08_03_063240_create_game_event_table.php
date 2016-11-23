<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_event', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('player_id')->references('id')->on('player');
            $table->bigInteger('team_id')->references('id')->on('team');
            $table->bigInteger('game_id')->references('id')->on('game');
            $table->integer('event_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
