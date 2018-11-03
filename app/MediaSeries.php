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

class MediaSeries extends Model
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
        // $exists = MediaSeries::where("title", $media->title)->first();

        // if($exists) {

        // }

        $exists = false;

        if ($exists) {
        } else {
            $new_media = MediaSeries::create([
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
        $netflix_series = NetflixSeries::all();

        foreach ($netflix_series as $media) {
            MediaSeries::makeMedia($media, "netflix", $media->genres);
        }
    }

    public static function migrate() 
    {

        MediaSeries::makeNetflixMedia();

        return MediaSeries::all();

    }
}
