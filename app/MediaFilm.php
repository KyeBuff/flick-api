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
        if(!($genres instanceof Collection)) {
            $genres = Genre::parse($genres);
        }
        $media->setGenres($genres);
    }

    private function setAppToMedia($media, $app) 
    {
        $app = App::parse($app);
        $media->setApps($app);
    }

    private static function makeMedia($media, $app, $genres = [])
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

            $new_media->setAppToMedia($new_media, [$app]);
        }

    }

    public static function migrateNetflix() 
    {
        $netflix_films = NetflixFilm::all();

        foreach ($netflix_films as $media) {
            MediaFilm::makeMedia($media, "netflix", $media->genres);
        }
    }

    public static function migrateAmazon() 
    {
        $amazon_films = AmazonFilm::all();

        foreach ($amazon_films as $media) {
            MediaFilm::makeMedia($media, "amazon", $media->genres);
        }
    }

    public static function migrateBbc() 
    {
        $bbc_films = BBCFilm::all();

        foreach ($bbc_films as $media) {
            MediaFilm::makeMedia($media, "bbc", $media->genres);
        }
    }

    public static function migrateItv() 
    {
        $itv_films = ITVFilm::all();

        foreach ($itv_films as $media) {
            MediaFilm::makeMedia($media, "itv", $media->genres);
        }
    }

    public static function migrateCFour() 
    {
        $c_four_films = CFourFilm::all();

        foreach ($c_four_films as $media) {
            MediaFilm::makeMedia($media, "c-four", $media->genres);
        }
    }

    public static function migrateiTunes() 
    {
        $i_tunes_films = iTunesFilm::all();

        foreach ($i_tunes_films as $media) {
            MediaFilm::makeMedia($media, "itunes", $media->genres);
        }
    }

    public static function migrateGoogle() 
    {
        $google_films = GoogleFilm::all();

        foreach ($google_films as $media) {
            MediaFilm::makeMedia($media, "google", $media->genres);
        }
    }


    public static function migrateRakuten() 
    {
        $rakuten_films = RakutenFilm::all();

        foreach ($rakuten_films as $media) {
            MediaFilm::makeMedia($media, "rakuten", $media->genres);
        }
    }

    public static function migrateAll() 
    {
        MediaFilm::migrateNetflix(); 
        MediaFilm::migrateAmazon(); 
        MediaFilm::migrateBbc(); 
        MediaFilm::migrateItv(); 
        MediaFilm::migrateCFour(); 
        MediaFilm::migrateiTunes(); 
        MediaFilm::migrateGoogle(); 
        MediaFilm::migrateRakuten(); 
    }

}
