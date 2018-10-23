<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Genre;
use App\NetflixFilm;
use App\NetflixSeries;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;

class NfxController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function setGenresToTitle($title, $genres) 
    {
        $genres = Genre::parse($genres);
        $title->setGenres($genres);
    }

    public function storeFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = NetflixFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = NetflixSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }
}
