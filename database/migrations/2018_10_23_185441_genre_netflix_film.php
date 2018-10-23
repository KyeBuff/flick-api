<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreNetflixFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_netflix_film', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("netflix_film_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("netflix_film_id")->references("id")->on("netflix_films")->onDelete("cascade");
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
        Schema::drop("genre_netflix_film");
    }
}
