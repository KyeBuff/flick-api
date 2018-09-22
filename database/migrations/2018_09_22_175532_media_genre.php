<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_media', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("media_id")->references("id")->on("media")->onDelete("cascade");
            $table->foreign("genre_id")->references("id")->on("genres")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("genre_media");
    }
}
