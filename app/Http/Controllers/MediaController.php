<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaListResource;

use Illuminate\Support\Collection;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MediaListResource::collection(Media::all())->shuffle();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexFilms()
    {

        $filtered_films = collect(MediaListResource::collection(Media::all()));

        return $filtered_films->filter(function ($film) {
            return $film['isFilm'];
        })->shuffle();
    }

    public function indexSeries()
    {
        $filtered_films = collect(MediaListResource::collection(Media::all()));

        return $filtered_films->filter(function ($film) {
            return !$film['isFilm'];
        })->shuffle();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->only(["title", "synopsis", "isFilm", "img_url"]);

        $media = Media::create($data);

        return response($media, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
