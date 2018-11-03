<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppMediaFilm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_media_film', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_film_id")->unsigned();
            $table->integer("app_id")->unsigned();
            $table->foreign("media_film_id")->references("id")->on("media_films")->onDelete("cascade");
            $table->foreign("app_id")->references("id")->on("apps")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("app_media_film");
    }
}
