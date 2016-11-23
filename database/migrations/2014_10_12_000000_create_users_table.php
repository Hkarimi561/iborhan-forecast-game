<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
	        $table->string('national_code')->nullable();
	        $table->bigInteger('city_id')->nullable();
	        $table->string('avatar');
	        $table->string('cell_phone')->nullable();
	        $table->string('phone')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('status')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('email')->nullable();
            $table->boolean('user_level');
            $table->string('password', 60);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
