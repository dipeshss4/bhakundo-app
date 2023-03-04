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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content");
            $table->string("image_url")->nullable();
            $table->string("video_url")->nullable();
            $table->unsignedBigInteger("author_id");
            $table->foreign("author_id")->on("authors")->references("id")->cascadeOnUpdate();
            $table->unsignedBigInteger("news_category_id");
            $table->integer("score")->default(0);
            $table->foreign("news_category_id")->on("news_categories")->references("id")->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('news');
    }
};
