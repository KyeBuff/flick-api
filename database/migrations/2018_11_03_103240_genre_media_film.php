<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreMediaFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_media_film', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_film_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("media_film_id")->references("id")->on("media_films")->onDelete("cascade");
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
        Schema::drop("genre_media_film");
    }
}
