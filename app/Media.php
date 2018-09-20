<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ["title", "synopsis", "isFilm", "img_url"];
}
