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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("logo")->nullable();
            $table->string("location");
            $table->string("coach");
            $table->string("coach_image")->nullable();
            $table->string("remarks")->nullable();
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger("league_id");
            $table->foreign("league_id")->on("leagues")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('teams');
    }
};
