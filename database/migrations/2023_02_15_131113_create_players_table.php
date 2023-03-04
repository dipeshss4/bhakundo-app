<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("player_name");
            $table->string("country");
            $table->string("position");
            $table->string("date_of_birth")->nullable();
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger("team_id");
            $table->foreign("team_id")->on("teams")->references("id")->cascadeOnUpdate();
            $table->string("remarks");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
};
