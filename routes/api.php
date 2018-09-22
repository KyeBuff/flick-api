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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* RELATIONSHIPS
Users - Apps
Users - Genres

Series - Genres
Series - Apps

Films - Genres
Films - Apps

Query strings for non logged in users specifying IDs of the apps and genres

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

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "MediaController@store"); 
});

/********************************************************
USERS
********************************************************/
$router->group(["prefix" => "user"], function ($router) {
	/*********************************
	GET
	*********************************/
    $router->get("", "Users@getUser"); 
    $router->get("apps", "Users@getApps");
    $router->get("genres", "Users@getGenres");

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "Users@addUser"); 
    $router->put("apps", "Users@setApps");
    $router->put("genres", "Users@setGenres");

});

