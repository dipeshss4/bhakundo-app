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
        Schema::create('news_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("news_id");
            $table->foreign("news_id")->on("news")->references("id")->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger("tag_id");
            $table->foreign("tag_id")->on("tags")->references("id")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('news_tags');
    }
};
