<?php

namespace App;
use App\NetflixSeries;
use App\AmazonSeries;
use App\BBCSeries;
use App\ITVSeries;
use App\CFourSeries;
use App\iTunesSeries;
use App\GoogleSeries;
use App\RakutenSeries;

use App\App;
use App\Genre;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Custom\MediaUtilities;

class MediaSeries extends Model
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
        $existing_media = MediaSeries::where("title", $media->title)->first();

        if ($existing_media) {

            $genres_merged = MediaSeries::mergeGenres($genres, $existing_media);

            // Recreates genres in the DB from a collection of titles
            $genres_merged = Genre::parse($genres_merged);

            $apps_merged = MediaSeries::mergeApps($apps, $existing_media);

            $existing_media->setGenresToMedia($existing_media, $genres_merged);
            $existing_media->setAppsToMedia($existing_media, $apps_merged);

        } else {
            $new_media = MediaSeries::create([
                "title" => $media->title,
                "year" => $media->year,
                "synopsis" => $media->synopsis,
                "img_url" => MediaUtilities::getImageUrl($media->title, 'tv'),
            ]);

            $new_media->setGenresToMedia($new_media, $genres);

            $new_media->setAppsToMedia($new_media, [$apps]);
        }

    }

    public static function migrateNetflix() 
    {
        $netflix_series = NetflixSeries::all();

        foreach ($netflix_series as $media) {
            MediaSeries::makeMedia($media, "netflix", $media->genres);
        }
    }

    public static function migrateAmazon() 
    {
        $amazon_series = AmazonSeries::all();

        foreach ($amazon_series as $media) {
            MediaSeries::makeMedia($media, "amazon", $media->genres);
        }
    }

    public static function migrateBbc() 
    {
        $bbc_series = BBCSeries::all();

        foreach ($bbc_series as $media) {
            MediaSeries::makeMedia($media, "bbc", $media->genres);
        }
    }

    public static function migrateItv() 
    {
        $itv_series = ITVSeries::all();

        foreach ($itv_series as $media) {
            MediaSeries::makeMedia($media, "itv", $media->genres);
        }
    }

    public static function migrateCFour() 
    {
        $c_four_series = CFourSeries::all();

        foreach ($c_four_series as $media) {
            MediaSeries::makeMedia($media, "c-four", $media->genres);
        }
    }

    public static function migrateiTunes() 
    {
        $i_tunes_series = iTunesSeries::all();

        foreach ($i_tunes_series as $media) {
            MediaSeries::makeMedia($media, "itunes", $media->genres);
        }
    }

    public static function migrateGoogle() 
    {
        $google_series = GoogleSeries::all();

        foreach ($google_series as $media) {
            MediaSeries::makeMedia($media, "google", $media->genres);
        }
    }


    public static function migrateRakuten() 
    {
        $rakuten_series = RakutenSeries::all();

        foreach ($rakuten_series as $media) {
            MediaSeries::makeMedia($media, "rakuten", $media->genres);
        }
    }

    public static function migrateAll() 
    {
        MediaSeries::migrateNetflix(); 
        MediaSeries::migrateAmazon(); 
        MediaSeries::migrateBbc(); 
        MediaSeries::migrateItv(); 
        MediaSeries::migrateCFour(); 
        MediaSeries::migrateiTunes(); 
        MediaSeries::migrateGoogle(); 
        MediaSeries::migrateRakuten(); 
    }

}
