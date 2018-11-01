<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreBbcFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbc_film_genre', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("bbc_film_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("bbc_film_id")->references("id")->on("bbc_films")->onDelete("cascade");
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
        Schema::drop("bbc_film_genre");
    }
}
