<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItvFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itv_films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->integer('year')->unsigned()->nullable();
            $table->longText('synopsis')->nullable();
            
            $table->timestamps();
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("itv_films");
    }
}