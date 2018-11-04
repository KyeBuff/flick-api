<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Setup scraper auth
        $netflix_scraper = new User([
            'name' => Config::get('services.scrapers.netflix.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.netflix.email'),
            'password' => bcrypt(Config::get('services.scrapers.netflix.password'))
        ]);

        $amazon_scraper = new User([
            'name' => Config::get('services.scrapers.amazon.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.amazon.email'),
            'password' => bcrypt(Config::get('services.scrapers.amazon.password'))
        ]);

        $bbc_scraper = new User([
            'name' => Config::get('services.scrapers.bbc.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.bbc.email'),
            'password' => bcrypt(Config::get('services.scrapers.bbc.password'))
        ]);

        $c_four_scraper = new User([
            'name' => Config::get('services.scrapers.c_four.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.c_four.email'),
            'password' => bcrypt(Config::get('services.scrapers.c_four.password'))
        ]);

        $google_scraper = new User([
            'name' => Config::get('services.scrapers.google.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.google.email'),
            'password' => bcrypt(Config::get('services.scrapers.google.password'))
        ]);

        $itunes_scraper = new User([
            'name' => Config::get('services.scrapers.itunes.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.itunes.email'),
            'password' => bcrypt(Config::get('services.scrapers.itunes.password'))
        ]);

        $itv_scraper = new User([
            'name' => Config::get('services.scrapers.itv.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.itv.email'),
            'password' => bcrypt(Config::get('services.scrapers.itv.password'))
        ]);

        $rakuten_scraper = new User([
            'name' => Config::get('services.scrapers.rakuten.id'),
            'role' => 'scraper',
            'email' => Config::get('services.scrapers.rakuten.email'),
            'password' => bcrypt(Config::get('services.scrapers.rakuten.password'))
        ]);

        $netflix_scraper->save();    
        $amazon_scraper->save();
        $bbc_scraper->save();
        $c_four_scraper->save();
        $google_scraper->save();
        $itunes_scraper->save();
        $itv_scraper->save();
        $rakuten_scraper->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
