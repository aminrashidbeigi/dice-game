<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('user1_id');
            $table->integer('user2_id');
            $table->integer('turn');
            $table->integer('user1_current_score');
            $table->integer('user2_current_score');
            $table->integer('user1_score');
            $table->integer('user2_score');
            $table->string('status');
            $table->integer('dice1');
            $table->integer('dice2');
            $table->integer('dice3');
            $table->integer('dice4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_status', function (Blueprint $table) {
            $table->drop();
        });
    }
}
