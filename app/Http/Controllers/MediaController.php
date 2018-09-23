<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaListResource;
use App\Genre;
use App\App;

use Illuminate\Support\Collection;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $filtered_films = collect(MediaListResource::collection(Media::all()));

        $genres = explode(',', $request->genres);

        $mediaToReturn = new Collection([]);

        foreach ($genres as $genre_id) {
            $genre = Genre::find($genre_id);

            if(!$genre) {
                continue;
            }

            $media = $genre->media()
                ->wherePivot('genre_id', '=', $genre_id)
                ->get(); // execute the query

            $mediaToReturn = $mediaToReturn->merge($media);
        }

        return MediaListResource::collection($mediaToReturn);

    }
        // return ModulesCourseResource::collection($course->modules->sortBy('order'));

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
        
        $data = $request->only(["title", "synopsis", "isFilm", "img_url", "genres", "apps"]);
        
        $genres = Genre::parse($request->get("genres"));
        $apps = App::parse($request->get("apps"));

        $media = Media::create($data);

        $media->setGenres($genres);
        $media->setApps($apps);

        return response($media, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        // return the resource
        return new MediaResource($media);
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
