<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenreCFourSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_four_series_genre', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("c_four_series_id")->unsigned();
            $table->integer("genre_id")->unsigned();
            $table->foreign("c_four_series_id")->references("id")->on("c_four_series")->onDelete("cascade");
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
        Schema::drop("genre_c_four_series");
    }
}
