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
    });
});

/********************************************************
USERS
********************************************************/
// $router->group(["prefix" => "user"], function ($router) {
// 	/*********************************
// 	GET
// 	*********************************/
//     $router->get("", "Users@getUser"); 
//     $router->get("apps", "Users@getApps");
//     $router->get("genres", "Users@getGenres");

// 	/*********************************
// 	POST/PUT
// 	*********************************/
//     $router->post("", "Users@store"); 
//     $router->put("apps", "Users@setApps");
//     $router->put("genres", "Users@setGenres");

// });

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
    $router->get('{media}', "MediaController@show"); 

    $router->get('{media}/apps', "Apps@mediaIndex"); 
    $router->get('{media}/genres', "Genres@mediaIndex"); 

	/*********************************
	POST/PUT
	*********************************/
    $router->post("", "MediaController@store"); 
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
