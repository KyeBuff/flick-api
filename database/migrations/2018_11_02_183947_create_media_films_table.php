<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->longText('synopsis')->nullable();
            $table->string('img_url', 10000)->nullable();
            $table->json('apps');
            $table->json('genres')->nullable();
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_films');
    }
}