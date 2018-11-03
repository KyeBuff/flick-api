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

use App\App;
use App\Genre;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MediaFilm extends Model
{
    protected $fillable = ["title", "synopsis", "img_url", "apps", "genres"];

    private function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    private function setGenres(Collection $genres)
    {
        // update the pivot table with tag IDs
        $this->genres()->sync($genres->pluck("id")->all());    
        return $this;
    }

    private function apps()
    {
        return $this->belongsToMany(App::class);
    }

    private function setApps(Collection $apps)
    {
        // update the pivot table with tag IDs
        $this->apps()->sync($apps->pluck("id")->all());    
        return $this;
    }

    private function setGenresToMedia($media, $genres) 
    {
        $genres = Genre::parse($genres);
        $media->setGenres($genres);
    }

    private function setAppToMedia($media, $app) 
    {
        $app = App::parse($app);
        $media->setApps($app);
    }

    private static function makeMedia($media, $app, $genres)
    {
        // $exists = MediaFilm::where("title", $media->title)->first();

        // if($exists) {

        // }

        $exists = false;

        if ($exists) {
        } else {
            $new_media = MediaFilm::create([
                "title" => $media->title,
                "synopsis" => $media->synopsis,
                "img_url" => $media->img_url,
            ]);

            $new_media->setGenresToMedia($new_media, $genres);
            $new_media->setAppToMedia($new_media, $app);
        }

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
