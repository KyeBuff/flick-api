<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppMediaSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_media_series', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_series_id")->unsigned();
            $table->integer("app_id")->unsigned();
            $table->foreign("media_series_id")->references("id")->on("media_series")->onDelete("cascade");
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
        Schema::drop("app_media_series");
    }
}
