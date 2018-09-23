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

    public static function filterMedia($genres, $apps) 
    {
        if(!$genres && !$apps) {
            return Media::get();
        }

        $media = null;

        if($genres) {
            $genres = explode(',', $genres);

            $media = Media::whereHas('genres', function ($q) use ($genres) {
                $q->whereIn('genre_id', $genres);
            });
        }

        if($apps) {
            if(is_string($apps)) {
                $apps = explode(',', $apps);
            }

            if($media) {
                $media->whereHas('apps', function ($q) use ($apps) { 
                    $q->whereIn('app_id', $apps);
                });
            } else {
                $media = Media::whereHas('apps', function ($q) use ($apps) { 
                    $q->whereIn('app_id', $apps);
                });
            }
        }

        return $media->get();
    }

    public static function filterFilms($genres, $apps) 
    {
        if(!$genres && !$apps) {
            return Media::where('isFilm', 1)->get();
        }

        $media = Media::where('isFilm', 1);

        if($genres) {
            $genres = explode(',', $genres);

            $media = $media::whereHas('genres', function ($q) use ($genres) {
                $q->whereIn('genre_id', $genres);
            });
        }

        if($apps) {
            if(is_string($apps)) {
                $apps = explode(',', $apps);
            }

            $media = $media->whereHas('apps', function ($q) use ($apps) { 
                $q->whereIn('app_id', $apps);
            });
        }

        return $media->get();
    }

    public static function filterSeries($genres, $apps) 
    {
        if(!$genres && !$apps) {
            return Media::where('isFilm', 0)->get();
        }
        
        $media = Media::where('isFilm', 0);

        if($genres) {
            $genres = explode(',', $genres);

            $media = $media::whereHas('genres', function ($q) use ($genres) {
                $q->whereIn('genre_id', $genres);
            });
        }

        if($apps) {
            
            if(is_string($apps)) {
                $apps = explode(',', $apps);
            }

            $media = $media->whereHas('apps', function ($q) use ($apps) { 
                $q->whereIn('app_id', $apps);
            });
        }

        return $media->get();
    }
}
