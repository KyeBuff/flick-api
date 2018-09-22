<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_media', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("media_id")->unsigned();
            $table->integer("app_id")->unsigned();
            $table->foreign("media_id")->references("id")->on("media")->onDelete("cascade");
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
        Schema::drop("app_media");
    }
}
