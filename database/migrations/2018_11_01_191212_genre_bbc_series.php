<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreBbcSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbc_series_genre', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("bbc_series_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("bbc_series_id")->references("id")->on("bbc_series")->onDelete("cascade");
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
        Schema::drop("bbc_series_genre");
    }
}
