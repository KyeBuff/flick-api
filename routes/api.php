<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');

        Route::post('user/apps', 'AuthController@storeAppsToUser');
        Route::get('user/apps', 'AuthController@indexApps');

   		Route::get("media", "MediaController@authIndex"); 
   		Route::get("films", "MediaController@authIndexFilms"); 
   		Route::get("series", "MediaController@authIndexSeries"); 
    });
});

/********************************************************
MEDIA
********************************************************/

$router->group(["prefix" => "media"], function ($router) {
	/*********************************
	GET
	*********************************/
    $router->get("", "MediaController@index"); 
    $router->get("films", "MediaController@indexFilms"); 
    $router->get("series", "MediaController@indexSeries"); 

    $router->get('migrate/all', "MediaController@migrateAll"); 
    $router->get('migrate/netflix', "MediaController@migrateNetflix"); 
    $router->get('migrate/amazon', "MediaController@migrateAmazon"); 
    $router->get('migrate/bbc', "MediaController@migrateBbc"); 
    $router->get('migrate/itv', "MediaController@migrateItv"); 
    $router->get('migrate/c-four', "MediaController@migrateCFour"); 
    $router->get('migrate/itunes', "MediaController@migrateiTunes"); 
    $router->get('migrate/google', "MediaController@migrateGoogle"); 
    $router->get('migrate/rakuten', "MediaController@migrateRakuten"); 
    
    $router->get('{media}', "MediaController@show"); 
    $router->get('{media}/apps', "Apps@mediaIndex"); 
    $router->get('{media}/genres', "Genres@mediaIndex"); 

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "MediaController@store"); 
});


/********************************************************
Netflix
********************************************************/
$router->group(["prefix" => "netflix"], function ($router) {
    $router->post("films", "MediaController@storeNetflixFilm"); 
    $router->post("series", "MediaController@storeNetflixSeries"); 
});

/********************************************************
Amazon
********************************************************/
$router->group(["prefix" => "amazon"], function ($router) {
    $router->post("films", "MediaController@storeAmazonFilm"); 
    $router->post("series", "MediaController@storeAmazonSeries"); 
});

/********************************************************
BBC
********************************************************/
$router->group(["prefix" => "bbc"], function ($router) {
    $router->post("films", "MediaController@storeBBCFilm"); 
    $router->post("series", "MediaController@storeBBCSeries"); 
});

/********************************************************
ITV
********************************************************/
$router->group(["prefix" => "itv"], function ($router) {
    $router->post("films", "MediaController@storeITVFilm"); 
    $router->post("series", "MediaController@storeITVSeries"); 
});

/********************************************************
CFour
********************************************************/
$router->group(["prefix" => "c-four"], function ($router) {
    $router->post("films", "MediaController@storeCFourFilm"); 
    $router->post("series", "MediaController@storeCFourSeries"); 
});

/********************************************************
iTunes
********************************************************/
$router->group(["prefix" => "itunes"], function ($router) {
    $router->post("films", "MediaController@storeiTunesFilm"); 
    $router->post("series", "MediaController@storeiTunesSeries"); 
});

/********************************************************
Google
********************************************************/
$router->group(["prefix" => "google"], function ($router) {
    $router->post("films", "MediaController@storeGoogleFilm"); 
    $router->post("series", "MediaController@storeGoogleSeries"); 
});

/********************************************************
Rakuten
********************************************************/
$router->group(["prefix" => "rakuten"], function ($router) {
    $router->post("films", "MediaController@storeRakutenFilm"); 
    $router->post("series", "MediaController@storeRakutenSeries"); 
});

/********************************************************
APPS
********************************************************/
$router->group(["prefix" => "apps"], function ($router) {
	/*********************************
	GET
	*********************************/
    $router->get("", "Apps@index"); 

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "Apps@store"); 
});


/********************************************************
GENRES
********************************************************/
$router->group(["prefix" => "genres"], function ($router) {
	/*********************************
	GET
	*********************************/
    $router->get("", "Genres@index"); 

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "Genres@store"); 
});
