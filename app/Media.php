<?php

namespace App;
use App\NetflixFilm;
use App\NetflixSeries;
use App\AmazonFilm;
use App\AmazonSeries;
use App\BBCFilm;
use App\BBCSeries;
use App\ITVFilm;
use App\ITVSeries;
use App\CFourFilm;
use App\CFourSeries;
use App\iTunesFilm;
use App\iTunesSeries;
use App\GoogleFilm;
use App\GoogleSeries;
use App\RakutenFilm;
use App\RakutenSeries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Media extends Model
{
    protected $fillable = ["title", "year", "synopsis", "img_url"];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function setGenres(Collection $genres)
	{
	    // update the pivot table with tag IDs
	    $this->genres()->sync($genres->pluck("id")->all());    
	    return $this;
	}

    public function apps()
    {
        return $this->belongsToMany(App::class);
    }

    public function setApps(Collection $apps)
    {
        // update the pivot table with tag IDs
        $this->apps()->sync($apps->pluck("id")->all());    
        return $this;
    }

    private static function makeMedia($media)
    {
        // $exists = Media::where("title", $media->title)->first();

        // if($exists) {

        // }

        $exists = false;

        return $exists ? $exists : Media::create([
            "title" => $media->title,
            "synopsis" => $media->synopsis,
            "img_url" => $media->img_url
        ]);
    }

    private static function makeNetflixMedia() 
    {
        $netflix_films = NetflixFilm::all();
        $netflix_series = NetflixSeries::all();

        foreach ($netflix_films as $media) {
            Media::makeMedia($media);
        }

        foreach ($netflix_series as $media) {
            Media::makeMedia($media);
        }
    }

    public static function migrate() 
    {

        Media::makeNetflixMedia();

        return Media::all();

    }

    private static function randomSeed()
    {
        $seed = '';
        for ($i=0; $i < 4; $i++) { 
            $seed .= rand(1, 15);
        }
        return $seed;
    }

    public static function filterBy($genres, $apps, $isFilm) 
    {
       if(!$genres && !$apps) {
            return Media::where('isFilm', $isFilm)->inRandomOrder(Media::randomSeed())->paginate(15);
        }
        
        $media = Media::where('isFilm', $isFilm);

        if($genres) {
            $genres = explode(',', $genres);
            $media = Media::queryData($genres, $media, 'genre');
        }

        if($apps) {
            $media = Media::queryData($apps, $media, 'app');
        }

        return $media->inRandomOrder(Media::randomSeed())->paginate(15);
    }

    public static function filterMedia($genres, $apps) 
    {


        if(!$genres && !$apps) {
            return Media::inRandomOrder(Media::randomSeed())->paginate(15);
        }

        $media = null;

        if($genres) {
            $genres = explode(',', $genres);

            $media = Media::whereHas('genres', function ($q) use ($genres) {
                $q->whereIn('genre_id', $genres);
            });
        }
        if($apps) {
            if($media) {
                $media = Media::queryData($apps, $media, 'app');
            } else {
                $media = Media::whereHas('apps', function ($q) use ($apps) { 
                    $q->whereIn('app_id', $apps);
                });
            }
        }

        return $media->inRandomOrder(Media::randomSeed())->paginate(15);
    }

    private static function queryData($data, $query, $name) {
        return $query->whereHas($name.'s', function ($q) use ($name, $data) { 
            $q->whereIn($name.'_id', $data);
        });
    }
}
