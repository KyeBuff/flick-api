<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreiTunesFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_i_tunes_film', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("i_tunes_film_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("i_tunes_film_id")->references("id")->on("i_tunes_films")->onDelete("cascade");
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
        Schema::drop("genre_i_tunes_film");
    }
}
