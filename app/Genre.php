<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ["title"];

    public function media()
	{
	    return $this->belongsToMany(Media::class);
	}

	private static function makeGenre($string)
	{
	    $exists = Genre::where("title", $string)->first();

	    return $exists ? $exists : Genre::create(["title" => $string]);
	}

	public static function parse(array $genres)
	{
	    return collect($genres)->map(function ($genre) {
	        return static::makeGenre($genre);
	    });
	}
}
