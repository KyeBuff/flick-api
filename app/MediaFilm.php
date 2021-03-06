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

use App\Custom\MediaUtilities;

class MediaFilm extends Model
{
    protected $fillable = ["title", "year", "synopsis", "img_url"];

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

    private static function mergeGenres($genres, $existing_media)
    {
        $genre_titles = $genres->map(function ($genre) {
            return $genre->title;
        });

        $existing_genre_titles = $existing_media->genres()->get()->map(function ($genre) {
            return $genre->title;
        });

        return $existing_genre_titles->merge($genre_titles);

    }

    private function apps()
    {
        return $this->belongsToMany(App::class);
    }

    private static function mergeApps($apps, $existing_media)
    {
        return App::parse([$apps])->merge($existing_media->apps()->get());
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

    private function setAppsToMedia($media, $apps) 
    {
        if(!($apps instanceof Collection)) {
            $apps = App::parse($apps);
        }
        $media->setApps($apps);
    }

    private static function makeMedia($media, $apps, $genres = [])
    {
        $existing_media = MediaFilm::where("title", $media->title)->first();

        if ($existing_media) {

            $genres_merged = MediaFilm::mergeGenres($genres, $existing_media);

            // Recreates genres in the DB from a collection of titles
            $genres_merged = Genre::parse($genres_merged);

            $apps_merged = MediaFilm::mergeApps($apps, $existing_media);

            $existing_media->setGenresToMedia($existing_media, $genres_merged);
            $existing_media->setAppsToMedia($existing_media, $apps_merged);

        } else {
            $new_media = MediaFilm::create([
                "title" => $media->title,
                "year" => $media->year,
                "synopsis" => $media->synopsis,
                "img_url" => MediaUtilities::getImageUrl($media->title, 'movie'),
            ]);

            $new_media->setGenresToMedia($new_media, $genres);

            $new_media->setAppsToMedia($new_media, [$apps]);
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
