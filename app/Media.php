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

    public static function filterMedia(string $genres, string $apps) 
    {
        $genres = explode(',', $genres);
        $apps = explode(',', $apps);

        return Media::whereHas('genres', function ($q) use ($genres) {
            $q->whereIn('genre_id', $genres);
        })->whereHas('apps', function ($q) use ($apps) { 
            $q->whereIn('app_id', $apps);
        })->get();
    }

    public static function filterFilms(string $genres, string $apps) 
    {
        $genres = explode(',', $genres);
        $apps = explode(',', $apps);

        return Media::where('isFilm', 1)->whereHas('genres', function ($q) use ($genres) {
            $q->whereIn('genre_id', $genres);
        })->whereHas('apps', function ($q) use ($apps) { 
            $q->whereIn('app_id', $apps);
        })->get();
    }

    public static function filterSeries(string $genres, string $apps) 
    {
        $genres = explode(',', $genres);
        $apps = explode(',', $apps);

        return Media::where('isFilm', 0)->whereHas('genres', function ($q) use ($genres) {
            $q->whereIn('genre_id', $genres);
        })->whereHas('apps', function ($q) use ($apps) { 
            $q->whereIn('app_id', $apps);
        })->get();
    }
}
