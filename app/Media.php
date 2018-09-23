<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Media extends Model
{
    protected $fillable = ["title", "synopsis", "isFilm", "img_url"];

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

    private static function randomSeed()
    {
        $seed = '';
        for ($i=0; $i < 4; $i++) { 
            $seed .= rand(1, 15);
        }
        return $seed;
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

    public static function filterFilms($genres, $apps) 
    {
        if(!$genres && !$apps) {
            return Media::where('isFilm', 1)->inRandomOrder(Media::randomSeed())->paginate(15);
        }

        $media = Media::where('isFilm', 1);

        if($genres) {
            $genres = explode(',', $genres);
            $media = Media::queryData($genres, $media, 'genre');
        }

        if($apps) {
            $media = Media::queryData($apps, $media, 'app');
        }

        return $media->inRandomOrder(Media::randomSeed())->paginate(15);
    }

    public static function filterSeries($genres, $apps) 
    {
        if(!$genres && !$apps) {
            return Media::where('isFilm', 0)->inRandomOrder(Media::randomSeed())->paginate(15);
        }
        
        $media = Media::where('isFilm', 0);

        if($genres) {
            $genres = explode(',', $genres);
            $media = Media::queryData($genres, $media, 'genre');
        }

        if($apps) {
            $media = Media::queryData($apps, $media, 'app');
        }

        return $media->inRandomOrder(Media::randomSeed())->paginate(15);
    }

    private static function queryData($data, $query, $name) {
        return $query->whereHas($name.'s', function ($q) use ($name, $data) { 
            $q->whereIn($name.'_id', $data);
        });
    }
}
