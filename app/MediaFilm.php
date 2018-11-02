<?php

namespace App;
use App\NetflixFilm;
use App\AmazonFilm;
use App\BBCFilm;
use App\ITVFilm;
use App\CFourFilm;
use App\iTunesFilm;
use App\GoogleFilm;
use App\RakutenFilm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MediaFilm extends Model
{
    protected $fillable = ["title", "synopsis", "img_url", "apps", "genres"];

    protected $casts = [
        'genres' => 'array',
        'apps' => 'array'
    ];

    private static function makeMedia($media, $app, $genres)
    {
        // $exists = MediaFilm::where("title", $media->title)->first();

        // if($exists) {

        // }

        $exists = false;

        return $exists ? $exists : MediaFilm::create([
            "title" => $media->title,
            "synopsis" => $media->synopsis,
            "img_url" => $media->img_url,
            "genres" => $genres,
            "apps" => [$app]
        ]);
    }

    private static function makeNetflixMedia() 
    {
        $netflix_films = NetflixFilm::all();

        foreach ($netflix_films as $media) {
            MediaFilm::makeMedia($media, "netflix", $media->genres);
        }
    }

    private static function makeAmazonMedia() 
    {
        $amazon_films = AmazonFilm::all();

        foreach ($amazon_films as $media) {
            MediaFilm::makeMedia($media, "amazon", $media->genres);
        }
    }

    private static function makeBbcMedia() 
    {
        $bbc_films = BbcFilm::all();

        foreach ($bbc_films as $media) {
            MediaFilm::makeMedia($media, "bbc", $media->genres);
        }
    }

    private static function makeItvMedia() 
    {
        $itv_films = ItvFilm::all();

        foreach ($itv_films as $media) {
            MediaFilm::makeMedia($media, "itv", $media->genres);
        }
    }

    private static function makeCFourMedia() 
    {
        $amazon_films = AmazonFilm::all();

        foreach ($amazon_films as $media) {
            MediaFilm::makeMedia($media, "amazon", $media->genres);
        }
    }

    public static function migrate() 
    {
        MediaFilm::makeNetflixMedia();

        return MediaFilm::all();

    }
}
