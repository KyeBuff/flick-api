<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreAmazonFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_film_genre', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("amazon_film_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("amazon_film_id")->references("id")->on("amazon_films")->onDelete("cascade");
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
        Schema::drop("amazon_film_genre");
    }
}
