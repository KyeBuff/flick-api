<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
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
        $media = Media::filterMedia($request->genres, $request->apps);

        return MediaListResource::collection($media);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexFilms(Request $request)
    {

        $media = Media::filterFilms($request->genres, $request->apps);

        return MediaListResource::collection($media);
    }

    public function indexSeries(Request $request)
    {
        $media = Media::filterSeries($request->genres, $request->apps);

        return MediaListResource::collection($media);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
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
