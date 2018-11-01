<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreItvSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_itv_series', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("itv_series_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("itv_series_id")->references("id")->on("itv_series")->onDelete("cascade");
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
        Schema::drop("genre_itv_series");
    }
}
