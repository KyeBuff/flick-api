<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreRakutenSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_rakuten_series', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("rakuten_series_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("rakuten_series_id")->references("id")->on("rakuten_series")->onDelete("cascade");
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
        Schema::drop("genre_rakuten_series");
    }
}
