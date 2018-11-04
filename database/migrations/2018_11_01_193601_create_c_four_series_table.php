<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCFourSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_four_series', function (Blueprint $table) {
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
        Schema::drop("c_four_series");
    }
}