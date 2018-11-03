<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use Carbon\Carbon;
use App\MediaFilm;
use App\MediaSeries;
use App\NetflixFilm;
use App\NetflixSeries;
use App\AmazonFilm;
use App\AmazonSeries;
use App\BBCFilm;
use App\BBCSeries;
use App\ITVFilm;
use App\ITVSeries;
use App\CFourFilm;
use App\CFourSeries;
use App\iTunesFilm;
use App\iTunesSeries;
use App\GoogleFilm;
use App\GoogleSeries;
use App\RakutenFilm;
use App\RakutenSeries;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaListResource;
use App\Genre;
use App\App;
use App\User;

use Illuminate\Support\Collection;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index(Request $request)
    // {
    //     $apps = $request->apps ? explode(',', $request->apps) : null;

    //     $media = Media::filterMedia($request->genres, $apps);

    //     return MediaListResource::collection($media);
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function indexFilms(Request $request)
    // {
    //     $apps = $request->apps ? explode(',', $request->apps) : null;

    //     $media = Media::filterBy($request->genres, $apps, 1);

    //     return MediaListResource::collection($media);
    // }

    // public function indexSeries(Request $request)
    // {
    //     $apps = $request->apps ? explode(',', $request->apps) : null;
    //     $media = Media::filterBy($request->genres, $apps, 0);

    //     return MediaListResource::collection($media);
    // }

    // public function authIndex(Request $request)
    // {
    //     if (!Auth::user()) abort(401, "Unauthorized.");

    //     $apps = collect(Auth::user()->getApps());

    //     $media = Media::filterMedia($request->genres, $apps);

    //     return MediaListResource::collection($media);
    // }
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function authIndexFilms(Request $request)
    // {
    //     if (!Auth::user()) abort(401, "Unauthorized.");

    //     $apps = collect(Auth::user()->getApps());

    //     $media = Media::filterBy($request->genres, $apps, 1);

    //     return MediaListResource::collection($media);
    // }

    // public function authIndexSeries(Request $request)
    // {
    //     if (!Auth::user()) abort(401, "Unauthorized.");

    //     $apps = Auth::user()->getApps();

    //     $media = Media::filterBy($request->genres, $apps, 0);

    //     return MediaListResource::collection($media);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(MediaRequest $request)
    // {
    //     $data = $request->only(["title", "synopsis", "isFilm", "img_url", "genres", "apps"]);
        
    //     $genres = Genre::parse($request->get("genres"));
    //     $apps = App::parse($request->get("apps"));

    //     $media = Media::create($data);

    //     $media->setGenres($genres);
    //     $media->setApps($apps);

    //     return response($media, 201);
    // }

    private function setGenresToTitle($title, $genres) 
    {
        $genres = Genre::parse($genres);
        $title->setGenres($genres);
    }

    public function storeNetflixFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = NetflixFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeNetflixSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = NetflixSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeAmazonFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = AmazonFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeAmazonSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = AmazonSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeBBCFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = BBCFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeBBCSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = BBCSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeITVFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = ITVFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeITVSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = ITVSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeCFourFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = CFourFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeCFourSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = CFourSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeiTunesFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = iTunesFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeiTunesSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = iTunesSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeGoogleFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = GoogleFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeGoogleSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = GoogleSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
    }

    public function storeRakutenFilm(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = RakutenFilm::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);
    }

    public function storeRakutenSeries(MediaRequest $request)
    {
        $data = $request->only(["title", "synopsis", "img_url", "genres"]);
        
        $genres = $request->get("genres");

        $title = RakutenSeries::create($data);

        if($genres) {
            $this->setGenresToTitle($title, $genres);
        }

        return response($title, 201);   
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


    /**
     * Migrate all media into media table
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function migrateNetflix() 
    {
        MediaFilm::migrateNetflix();
        // MediaSeries::migrateNetflix();
        return response('Succesful migration', 200);
    }

    public function migrateAmazon() 
    {
        MediaFilm::migrateAmazon();
        // MediaSeries::migrateAmazon();
        return response('Succesful migration', 200);
    }

    public function migrateBbc() 
    {
        MediaFilm::migrateBbc();
        // MediaSeries::migrateBbc();
        return response('Succesful migration', 200);
    }

    public function migrateItv() 
    {
        MediaFilm::migrateItv();
        // MediaSeries::migrateItv();
        return response('Succesful migration', 200);
    }

    public function migrateCFour() 
    {
        MediaFilm::migrateCFour();
        // MediaSeries::migrateCFour();
        return response('Succesful migration', 200);
    }

    public function migrateiTunes() 
    {
        MediaFilm::migrateiTunes();
        // MediaSeries::migrateiTunes();
        return response('Succesful migration', 200);
    }

    public function migrateGoogle() 
    {
        MediaFilm::migrateGoogle();
        // MediaSeries::migrateGoogle();
        return response('Succesful migration', 200);
    }

    public function migrateRakuten() 
    {
        MediaFilm::migrateRakuten();
        // MediaSeries::migrateRakuten();
        return response('Succesful migration', 200);
    }

    public function migrateAll()
    {   
        MediaFilm::migrateAll();
        // MediaSeries::migrateAll();
        return response('Succesful migration', 200);
    }
}
