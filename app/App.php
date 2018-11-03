<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = ["title"];

    public function mediaFilm()
	{
	    return $this->belongsToMany(MediaFilm::class);
	}

    public function mediaSeries()
	{
	    return $this->belongsToMany(MediaSeries::class);
	}

	private static function makeApp($string)
	{
	    $exists = App::where("title", $string)->first();

	    return $exists ? $exists : App::create(["title" => $string]);
	}

	public static function parse(array $apps)
	{
	    return collect($apps)->map(function ($app) {
	        return static::makeApp($app);
	    });
	}

    public function users()
    {
        return $this->belongsToMany(User::class);
    }	
}
