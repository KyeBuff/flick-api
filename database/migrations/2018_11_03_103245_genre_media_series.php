<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreMediaSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_media_series', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_series_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("media_series_id")->references("id")->on("media_series")->onDelete("cascade");
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
        Schema::drop("genre_media_series");
    }
}
