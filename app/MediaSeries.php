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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MediaSeries extends Model
{
    protected $fillable = ["title", "synopsis", "img_url", "apps", "genres"];

    protected $casts = [
        'genres' => 'array',
        'apps' => 'array'
    ];

    private static function makeMedia($media, $app, $genres)
    {
        // $exists = MediaSeries::where("title", $media->title)->first();

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
