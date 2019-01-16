<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateGameDesignTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('gamedesign',function(Blueprint $table){
            $table->increments("id");
            $table->string("maximum_score");
            $table->string("current_score")->nullable();
            $table->string("dice_number")->nullable();
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
        Schema::drop('gamedesign');
    }

}