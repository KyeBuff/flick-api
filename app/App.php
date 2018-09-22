<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = ["title", "icon"];

    public function media()
	{
	    return $this->belongsToMany(Media::class);
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
}
