<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\NetflixFilm::class, 50)->create();
        factory(App\NetflixSeries::class, 50)->create();

        factory(App\AmazonFilm::class, 50)->create();
        factory(App\AmazonSeries::class, 50)->create();

        factory(App\BbcFilm::class, 50)->create();
        factory(App\BbcSeries::class, 50)->create();

        factory(App\GoogleFilm::class, 50)->create();
        factory(App\GoogleSeries::class, 50)->create();

        factory(App\CFourFilm::class, 50)->create();
        factory(App\CFourSeries::class, 50)->create();

        factory(App\iTunesFilm::class, 50)->create();
        factory(App\iTunesSeries::class, 50)->create();

        factory(App\RakutenFilm::class, 50)->create();
        factory(App\RakutenSeries::class, 50)->create();
    }
}