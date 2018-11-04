<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NetflixSeries extends Model
{
    protected $fillable = ["title", "year", "synopsis"];

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
}
